@extends('admin/layouts/app',["title"=>"Add Packages"])

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Packages</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('admin.packages.index') }}">Packages</a></li>
                    <li class="breadcrumb-item active">Edit Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @livewire('admin.packages.edit-form', ['package' => $package]);
        </section>

    </main><!-- End #main -->
@endsection
