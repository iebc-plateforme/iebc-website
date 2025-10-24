@extends('admin.layouts.app')

@section('title', 'Modifier le thème')
@section('page-title', 'Modifier le thème: ' . $theme->display_name)

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.themes.update', $theme) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.themes._form')

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour le thème
                </button>
                <a href="{{ route('admin.themes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
