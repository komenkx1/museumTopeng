<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return view("admin.package.index");
    }

    public function create()
    {
        return view("admin.package.add");
    }

    public function edit(Package $package)
    {
        return view("admin.package.edit", compact("package"));
    }
}
