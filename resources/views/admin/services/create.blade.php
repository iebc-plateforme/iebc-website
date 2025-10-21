@extends('admin.layouts.app')

@section('title', 'Créer un Nouveau Service')
@section('page-title', 'Créer un Nouveau Service')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nouveau Service</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form')
            <button type="submit" class="btn btn-primary">Créer le Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection