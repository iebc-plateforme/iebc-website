@extends('admin.layouts.app')

@section('title', 'Modifier le Service')
@section('page-title', 'Modifier le Service')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le Service</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.services._form')
            <button type="submit" class="btn btn-primary">Mettre à jour le Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection