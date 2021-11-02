<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khsing\World\Models\City;
use Khsing\World\Models\CityLocale;
use Khsing\World\Models\Country;
use Khsing\World\World;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view("front.index", compact("packages"));
    }

    public function transaction(Package $package)
    {
        $countries = World::Countries();
        return view("front.transaction", compact("package", "countries"));
    }

    public function getProvince(Request $request)
    {
        // dd($request->code);
        $countries = Country::getByCode($request->code);
        $provinces = $countries->children();
        return json_encode($provinces);
        // dd($provinces);
    }

    public function checkout(Request $request)
    {
        $country = Country::getByCode($request->country);
        $request->validate([
            "name" => "required",
            "email" => "required",
            "country" => "required",
            "province" => "required",
            "city" => "required",
            "address" => "required",
            "phone" => "required|Numeric",
        ]);
        $personData = $request->all();
        $personData["country"] = $country->name;
        DB::beginTransaction();

        $currentGuest = Guest::create($personData);
        $currentPackage = Package::where("id", $request->package_id)->first();
        DB::commit();

        if ($request->paymentMehod == "transfer") {
        DB::beginTransaction();

            $array = array(
                'key' => 'SANDBOX64492A10-B70E-457F-A3CE-C72D56D84AB0-20211101225225',
                'action' => 'payment',
                'product' => $currentPackage->name,
                'price' => $currentPackage->price,
                'quantity' => '1',
                'buyer_name' => $currentGuest->name,
                'buyer_email' => $currentGuest->email,
                'buyer_phone' => $currentGuest->phone,
                'comments' => 'Keterangan Produk',
                'ureturn' => 'https://museum-topeng.menkz.xyz/',
                'unotify' => route("home.transaction.checkout.notify"),
                'ucancel' => 'https://museum-topeng.menkz.xyz/',
                'format' => 'json'
            );

            $data = http_build_query($array);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sandbox.ipaymu.com/payment.htm',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = json_decode(curl_exec($curl), 1);
            // dd($response);
            curl_close($curl);
            // echo $response;

            Transaction::create([
                "id_guest" => $currentGuest->id,
                "id_package" => $currentPackage->id,
                "session_ID" => $response['sessionID'],
                "url" => $response['url'],
                "status" => 'pending',
                "payment_method" => "TRANSFER",
            ]);
        DB::commit();
            return redirect($response['url']);
        }else {
            DB::beginTransaction();
            Transaction::create([
                "id_guest" => $currentGuest->id,
                "id_package" => $currentPackage->id,
                "trx_id" =>  "COD".$currentGuest->id.substr(md5(uniqid(rand(1,6))), 0, 8),
                "status" => 'pending',
                "payment_method" => "COD",
            ]);
            DB::commit();

            return redirect()->route("home")->with("success","Transaksi Nerhasil Dilakukan. Mohon Cek Email Anda");
        }
    }

    public function notify(Request $request)
    {
        $trx_id = $request->trx_id;
        $sid = $request->sid;
        $status = $request->status;
        // dd($sid);
        $cek = Transaction::where("session_ID", $sid)->first();

        if ($status == "berhasil") {
            $cek->paid_at = now();
            $cek->status = $status;
            $cek->trx_id =  $trx_id;
        } else {
            $cek->status = $request->status;
        }
        $cek->update();
        return response()->json(['status' => 'ok']);
    }
}
