<div>
    <div  wire:ignore.self class="modal fade" id="detailFeautureModal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form action="">
                    <div class="row">
                        <label for="inputText" class="col-12 col-form-label">Package Name <span
                                class="text-danger">*</span></label>
                        <div class="col-12">
                            <input type="text" class=" @error('name') is-invalid @enderror form-control"
                                placeholder="Input Package Feauture Name" wire:model="name">
                            @error('name')
                                <span class="invalid-feedback"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                   </form>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="update({{ $selectedFeauture->id??"" }})">Save changes</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('CloseModalDetail', event => {
            $('#detailFeautureModal').modal('hide');
        });

        document.addEventListener('OpenModalDetail', event => {
            $('#detailFeautureModal').modal('show');
        });
    </script>
@endpush
