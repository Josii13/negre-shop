@extends('admin.layouts.app')

@section('title', 'Gestion du Carrousel')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gestion du Carrousel</h1>
    <a href="{{ route('admin.developer.carousel.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouveau Slide
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des Slides</h6>
    </div>
    <div class="card-body">
        @if($slides->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $slide)
                    <tr>
                        <td>{{ $slide->order }}</td>
                        <td>
                            @if($slide->image)
                            <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" style="max-width: 100px; height: auto;">
                            @else
                            <span class="text-muted">Aucune image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $slide->title }}</strong><br>
                            <small class="text-muted">{{ $slide->subtitle }}</small>
                        </td>
                        <td>
                            @if($slide->is_active)
                            <span class="badge badge-success">Actif</span>
                            @else
                            <span class="badge badge-secondary">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.developer.carousel.edit', $slide) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.developer.carousel.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-images fa-3x text-gray-300 mb-3"></i>
            <p class="text-muted">Aucun slide pour le moment.</p>
            <a href="{{ route('admin.developer.carousel.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Créer le premier slide
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

