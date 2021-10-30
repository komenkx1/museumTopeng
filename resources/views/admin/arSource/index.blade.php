@extends('admin/layouts/app',["title"=>"AR Resource"])
@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
        <div class="titile">
            <h1>Add Source AR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item">Augmented Reality</li>
                </ol>
            </nav>
        </div>
        <div class="btnAdd">
            <a class="btn btn-success" href="{{ Route("admin.augmented-reality.create") }}"><i class="bi bi-plus fw-bold" style="font-size: 20px"></i></a>
        </div>
        
    </div><!-- End Page Title -->
<div class="card p-5">
    @livewire('admin.augmented-reality-table')

</div>
</main>
@endsection
