@extends('admin.layouts.app')

@section('title', 'Éditer ' . ucfirst($page))

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Éditer la Page : {{ ucfirst($page) }}</h1>
    <a href="{{ route('admin.developer.page-contents.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Form Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Contenu de la Page</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.developer.page-contents.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.developer.page-contents.forms.' . $page)

            <hr>

            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

