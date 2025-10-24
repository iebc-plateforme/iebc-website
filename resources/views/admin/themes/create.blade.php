@extends('admin.layouts.app')

@section('title', 'Créer un nouveau thème')
@section('page-title', 'Créer un nouveau thème')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.themes.store') }}" method="POST">
            @csrf

            @include('admin.themes._form')

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Créer le thème
                </button>
                <a href="{{ route('admin.themes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
