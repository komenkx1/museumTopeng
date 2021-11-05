@extends('admin/layouts/app',["title"=>"Add Event"])
@section('styles')
    <style>
        .imgPreview {
            height: 456px;
            /* width: 304px; */
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
            <h1>Add Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('admin.events.index') }}">Event</a></li>
                    <li class="breadcrumb-item active">Add Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="card mt-3">
                        <div class="card-body">

                            <!-- General Form Elements -->
                            <form enctype="multipart/form-data" method="POST"
                                action="{{ Route('admin.events.store') }}" class="p-3">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-12 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input type="text" class=" @error('name') is-invalid @enderror form-control"
                                            placeholder="Input Event Name" name="name">
                                        @error('name')
                                            <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="inputNumber" class="col-12 col-form-label">Upload Image Thumbnail <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input accept=".png,.jpg,.jpeg" name="image_url"
                                            class="@error('image_url') is-invalid @enderror form-control" type="file"
                                            id="formFileContent"
                                            onchange="document.getElementById('contentImg').style.backgroundImage = 'url('+window.URL.createObjectURL(this.files[0])+')'">
                                        @error('image_url')
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
                    <p class=" fw-bold">Preview Content</p>
                    <div class="imgPreview card  mx-auto" id="contentImg">
                        <img src="" alt="">
                    </div>


                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
