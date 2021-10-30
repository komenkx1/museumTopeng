<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\AugmentedReality;
use Illuminate\Http\Request;

class AugmentedRealityController extends Controller
{
    public function index()
    {
        $augmentedReality = AugmentedReality::all();
        return view("front.augmentedReality.index", compact('augmentedReality'));
    }


}
