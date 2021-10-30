@extends('admin/layouts/app',["title"=>"Edit AR Resource"])
@section('styles')
    <style>
        .imgPreview {
            height: 400px;

            overflow: hidden;
            position: relative;
            background-position: center;
            background-size: cover;
        }

        .imgPreview img {
            position: absolute;
            margin: auto;
            min-height: 100%;
            min-width: 100%;
        }

    </style>
@endsection
@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Source AR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('admin.augmented-reality.index') }}">Augmented
                            Reality</a></li>
                    <li class="breadcrumb-item active">Edit Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span>Generate Marker & Content for Augmented Reality on this <a class="fw-bold"
                            href="https://ar-generator.menkz.xyz/pages/marker/index.html" target="_blank">Site. </a> <br> After After getting the generated results, upload the asset file
                        in the zip file to the form below.</span>
                    <div class="card mt-3">
                        <div class="card-body">

                            <!-- General Form Elements -->
                            <form enctype="multipart/form-data" method="POST"
                                action="{{ Route('admin.augmented-reality.update', ["augmented_reality" => $augmentedReality->id]) }}" class="p-3">
                                @csrf
                                @method("patch")
                                <div class="row mb-3">
                                    <label for="inputText" class="col-12 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input type="text" class=" @error('name') is-invalid @enderror form-control"
                                            placeholder="Input Augmented Reality Name" name="name"
                                            value="{{ $augmentedReality->name }}">
                                        @error('name')
                                            <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-12 col-form-label">Upload Marker <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input accept=".patt" name="marker_file_url"
                                            class="@error('marker_file_url') is-invalid @enderror form-control mb-2"
                                            type="file" id="formFileMarker">
                                        <span class="fw-bold"><small id="oldMarker"> Old Marker :
                                                {{ $oldMarkerName }}</small></span>
                                        @error('marker_file_url')
                                            <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="inputNumber" class="col-12 col-form-label">Upload Content <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input accept=".png,.jpg,.jpeg" name="content_file_url"
                                            class="@error('content_file_url') is-invalid @enderror form-control" type="file"
                                            id="formFileContent"
                                            onchange="document.getElementById('contentImg').style.backgroundImage = 'url('+window.URL.createObjectURL(this.files[0])+')'">
                                        @error('content_file_url')
                                            <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-12">
                    <p class="text-center fw-bold">Preview Content</p>
                    <div class="imgPreview card  mx-auto" id="contentImg"
                        style="background-image: url({{ $augmentedReality->content_file }})">
                        <img src="" alt="">
                    </div>


                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
    <script>
        var value = document.getElementById("formFileMarker");

        value.onchange = function(event) {
            var fileList = value.files;

            $('#oldMarker').html("New Marker  : " + fileList[0]['name']);
            
        }
    </script>
@endsection
