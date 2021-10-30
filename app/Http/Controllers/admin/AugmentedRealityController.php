<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AugmentedReality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AugmentedRealityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.arSource.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.arSource.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required"],
            "marker_file_url" => ["required", "mimetypes:text/plain"],
            "content_file_url" => ["required", "mimes:png,jpg,jpeg"],
        ]);
        $ar = new AugmentedReality();
        DB::beginTransaction();
        $ar->name = $request->name;
        $ar->marker_id = "AUgmentedReality" . md5(now()) . "-" . $request->name;

        $fileMarker = $request->file('marker_file_url');
        $fileContent = $request->file('content_file_url');

        if ($fileMarker) {
            $nama_image = "AugmentedReality/marker/" . md5(now() . "_" . $fileMarker->getClientOriginalName()) . '.' . $fileMarker->getClientOriginalExtension();
            $fileMarker->storeAs('public', $nama_image);
            $ar->marker_file_url = $nama_image;
        }
        if ($fileContent) {
            $nama_image = "AugmentedReality/content/" . md5(now() . "_" . $fileContent->getClientOriginalName()) . '.' . $fileContent->getClientOriginalExtension();
            $fileContent->storeAs('public', $nama_image);
            $ar->content_file_url = $nama_image;
        }

        $ar->save();
        DB::commit();
        return redirect()->route("admin.augmented-reality.index")->with('toast_success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AugmentedReality  $augmentedReality
     * @return \Illuminate\Http\Response
     */
    public function show(AugmentedReality $augmentedReality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AugmentedReality  $augmentedReality
     * @return \Illuminate\Http\Response
     */
    public function edit(AugmentedReality $augmentedReality)
    {
        $oldMarker = explode('/', $augmentedReality->marker_file_url);
        $oldMarkerName = $oldMarker[2];
        return view("admin.arSource.edit", compact('augmentedReality', 'oldMarkerName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AugmentedReality  $augmentedReality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AugmentedReality $augmentedReality)
    {
        $request->validate([
            "name" => ["required"],
            "marker_file_url" => ["mimetypes:text/plain"],
            "content_file_url" => ["mimes:png,jpg,jpeg"],
        ]);

        DB::beginTransaction();
        $augmentedReality->name = $request->name;
        $fileMarker = $request->file('marker_file_url');
        $fileContent = $request->file('content_file_url');

        if ($fileMarker) {
            $nama_image = "AugmentedReality/marker/" . md5(now() . "_" . $fileMarker->getClientOriginalName()) . '.' . $fileMarker->getClientOriginalExtension();
            Storage::delete('public/' . $augmentedReality->marker_file_url);
            $fileMarker->storeAs('public', $nama_image);
            $augmentedReality->marker_file_url = $nama_image;
        }
        if ($fileContent) {
            $nama_image = "AugmentedReality/content/" . md5(now() . "_" . $fileContent->getClientOriginalName()) . '.' . $fileContent->getClientOriginalExtension();
            Storage::delete('public/' . $augmentedReality->content_file_url);
            $fileContent->storeAs('public', $nama_image);
            $augmentedReality->content_file_url = $nama_image;
        }

        $augmentedReality->update();
        DB::commit();
        return redirect()->route("admin.augmented-reality.index")->with('toast_info', 'Data berhasil dibuat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AugmentedReality  $augmentedReality
     * @return \Illuminate\Http\Response
     */
    public function destroy(AugmentedReality $augmentedReality)
    {
        //
    }
}
