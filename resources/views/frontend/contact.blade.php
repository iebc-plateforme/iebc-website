@extends('layouts.frontend')

@section('title', 'Contact - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Contactez-nous pour toute demande d\'information')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-envelope me-3"></i>Contactez-nous</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom complet *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email *</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Sujet *</label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Message *</label>
                                <textarea name="message" rows="6" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row mt-5 g-4">
                    @php
                        $email = \App\Models\Setting::get('contact_email');
                        $phone = \App\Models\Setting::get('contact_phone');
                        $address = \App\Models\Setting::get('contact_address');
                    @endphp

                    @if($email)
                        <div class="col-md-4 text-center">
                            <div class="contact-info-box">
                                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                                <h5>Email</h5>
                                <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                            </div>
                        </div>
                    @endif

                    @if($phone)
                        <div class="col-md-4 text-center">
                            <div class="contact-info-box">
                                <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                                <h5>Téléphone</h5>
                                <p><a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                            </div>
                        </div>
                    @endif

                    @if($address)
                        <div class="col-md-4 text-center">
                            <div class="contact-info-box">
                                <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                                <h5>Adresse</h5>
                                <p>{{ $address }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
