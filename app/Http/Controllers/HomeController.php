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

    }
}
