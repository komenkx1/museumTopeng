<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Package;
use Illuminate\Http\Request;
use Khsing\World\Models\City;
use Khsing\World\Models\CityLocale;
use Khsing\World\Models\Country;
use Khsing\World\World;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view("front.index",compact("packages"));
    }

    public function transaction(Package $package)
    {
        $countries = World::Countries();
        return view("front.transaction", compact("package","countries"));
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
            "email" => "required|unique:guests,email",
            "country" => "required",
            "province" => "required",
            "city" => "required",
            "address" => "required",
            "phone" => "required|Numeric",
        ]);
        $personData = $request->all();
        $personData["country"] = $country->name;
        $currentGuest = Guest::create($personData);
        $currentPackage = Package::where("id", $request->package_id)->first();

        if ($request->paymentMehod == "transfer") {
            $array = array(
                'key' => "E879A0A5-A66D-4ED0-BCA3-1D88221A19C5",
                'product' => $currentPackage->name,
                'qty' => '1',
                'price' => $currentPackage->price,
                'returnUrl' => 'https://ipaymu.com/return',
                'notifyUrl' => 'https://ipaymu.com/notify',
                'cancelUrl' => 'https://ipaymu.com/cancel',
                'buyerName' => $currentGuest->name,
                'buyerEmail' => $currentGuest->email,
                'buyerPhone' => $currentGuest->phone);
            
            $data = http_build_query($array);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://sandbox.ipaymu.com/api/v2/payment',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'signature: [object Object]',
                'va: 1179000899',
                'timestamp: 20191209155701'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
        }



    }
}
