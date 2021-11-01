<div class="mt-3">
   <form wire:submit.prevent="store()">
    <div class="row mb-3">
        <label for="inputText" class="col-12 col-form-label">Name <span
                class="text-danger">*</span></label>
        <div class="col-12">
            <input type="text" required class=" @error('name') is-invalid @enderror form-control"
                placeholder="Input Package Name" wire:model="name">
            @error('name')
                <span class="invalid-feedback"><small>{{ $message }}</small></span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputText" class="col-12 col-form-label">Price <span
                class="text-danger">*</span></label>
        <div class="col-12">
            <input type="number" required class=" @error('price') is-invalid @enderror form-control"
                placeholder="Input Package Price" wire:model="price">
            @error('price')
                <span class="invalid-feedback"><small>{{ $message }}</small></span>
            @enderror
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="inputText" class="col-12 col-form-label">Feauture <span
                class="text-danger">*</span></label>
        <div class="col-11">
            <input type="text" required class=" @error('feauture_name.0') is-invalid @enderror form-control"
                placeholder="Input Package Feauture" wire:model="feauture_name.0">
            @error('feauture_name.0')
                <span class="invalid-feedback"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="col-1 text-center">
            <button class="btn btn-success" type="button" wire:click.prevent="add({{$i}})"><i class="bi bi-plus"></i></button>
        </div>
    </div>

    @foreach ($inputs as $key => $value)
    <div class="row mb-3">
        <label for="inputText" class="col-12 col-form-label">Feauture</label>
        <div class="col-11">
            <input type="text" class=" @error('feauture_name.') is-invalid @enderror form-control"
                placeholder="Input Package Feauture" wire:model="feauture_name.{{ $value }}">
            @error('feauture_name.')
                <span class="invalid-feedback"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="col-1 text-center">
            <button class="btn btn-success" wire:click.prevent="add({{$key}})"><i class="bi bi-plus"></i></button>
            <button class="btn btn-danger" wire:click.prevent="remove({{$key}})"><i class="bi bi-trash"></i></button>
        </div>
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>
