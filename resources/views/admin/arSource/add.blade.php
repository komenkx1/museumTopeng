@extends('admin/layouts/app',["title"=>"Add AR Resource"])
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
            <h1>Add Source AR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('admin.augmented-reality.index') }}">Augmented
                            Reality</a></li>
                    <li class="breadcrumb-item active">Add Form</li>
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
                                action="{{ Route('admin.augmented-reality.store') }}" class="p-3">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-12 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input type="text" class=" @error('name') is-invalid @enderror form-control"
                                            placeholder="Input Augmented Reality Name" name="name">
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
                                            class="@error('marker_file_url') is-invalid @enderror form-control" type="file"
                                            id="formFileMarker">
                                        @error('marker_file_url')
                                            <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="inputNumber" class="col-12 col-form-label">Upload Content <span
                                            class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <input accept=".png,.jpg,.jpeg,.mp4" name="content_file_url"
                                            class="@error('content_file_url') is-invalid @enderror form-control" type="file"
                                            id="formFileContent">
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
                    <video controls id="video1" class="d-none" style="width: 100%; height: auto; margin:0 auto; frameborder:0;">
                        <source src="" type="video/mp4">
                            Your browser doesn't support HTML5 video tag.
                    </video>
                    <div class="imgPreview card  mx-auto" id="contentImg">
                  
                    </div>


                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('scripts')
<script>
    document.getElementById("formFileContent")
.onchange = function(event) {
    var $source = $('#video1');
 const name = event.target.files[0].name;
 const lastDot = name.lastIndexOf('.');
 const fileName = name.substring(0, lastDot);
 const ext = name.substring(lastDot + 1);

 if (ext == "mp4") {
    $("#video1").removeClass( "d-none" );
    $("#contentImg").addClass("d-none");
    document.getElementById('contentImg').style.backgroundImage = 'unset';
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
 }else{
     $("#video1").addClass("d-none");
    $("#contentImg").removeClass("d-none");

    document.getElementById('contentImg').style.backgroundImage = 'url('+window.URL.createObjectURL(this.files[0])+')'
 }

console.log(ext);
  
}
</script>
@endsection
