@push('styles')
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
@endpush
<div>
    <div class="modal fade" id="detailArModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail AR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    AR Content
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <div class="imgPreview card  mx-auto" id="contentImg"
                                        style="background-image: url({{ $selectedAR->content_file ?? '' }})">
                                        <img src="" alt="">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('CloseModalDetail', event => {
            $('#detailArModal').modal('hide');
        });

        document.addEventListener('OpenModalDetail', event => {
            $('#detailArModal').modal('show');
        });
    </script>
@endpush
