@extends('admin/layouts/app',["title"=>"Gallery"])
@section('content')
    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between">
            <div class="titile">
                <h1>Add Image Gallery</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item">Add Image Gallery</li>
                    </ol>
                </nav>
            </div>

        </div><!-- End Page Title -->
        <div class="card p-5">
            <form action="{{ Route("admin.gallery.store") }}"
            class="dropzone"
            id="my-awesome-dropzone" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="dz-message">
                Drag and Drop Single/Multiple Files Here<br>
            </div>
            <div id="preview-template"></div>
        </form>

        </div>
    </main>
@endsection
@section('scripts')
 <script>
    var dropzone = new Dropzone('#my-awesome-dropzone', {
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        parallelUploads: 3,
        thumbnailHeight: 150,
        thumbnailWidth: 150,
        maxFilesize: 5,
        filesizeBase: 1500,
        thumbnail: function (file, dataUrl) {
            if (file.previewElement) {
                file.previewElement.classList.remove("dz-file-preview");
                var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                for (var i = 0; i < images.length; i++) {
                    var thumbnailElement = images[i];
                    thumbnailElement.alt = file.name;
                    thumbnailElement.src = dataUrl;
                }
                setTimeout(function () {
                    file.previewElement.classList.add("dz-image-preview");
                }, 1);
            }
        }
    });
    
    var minSteps = 6,
        maxSteps = 60,
        timeBetweenSteps = 100,
        bytesPerStep = 100000;

    dropzone.uploadFiles = function (files) {
        var self = this;

        for (var i = 0; i < files.length; i++) {

            var file = files[i];
            totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

            for (var step = 0; step < totalSteps; step++) {
                var duration = timeBetweenSteps * (step + 1);
                setTimeout(function (file, totalSteps, step) {
                    return function () {
                        file.upload = {
                            progress: 100 * (step + 1) / totalSteps,
                            total: file.size,
                            bytesSent: (step + 1) * file.size / totalSteps
                        };

                        self.emit('uploadprogress', file, file.upload.progress, file.upload
                            .bytesSent);
                        if (file.upload.progress == 100) {
                            file.status = Dropzone.SUCCESS;
                            self.emit("success", file, 'success', null);
                            self.emit("complete", file);
                            self.processQueue();
                        }
                    };
                }(file, totalSteps, step), duration);
            }
        }
    }

</script>
@endsection
