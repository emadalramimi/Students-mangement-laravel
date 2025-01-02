@extends('layouts.app')

@section('title', 'Détails de l\'élève')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-user me-3"></i>
            <h2 class="mb-0">Détails de l'Élève</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-primary"><strong>Nom:</strong> {{ $eleve->nom }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-primary"><strong>Prénom:</strong> {{ $eleve->prenom }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-primary"><strong>Numéro Étudiant:</strong> {{ $eleve->numero_etudiant }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-primary"><strong>Email:</strong> {{ $eleve->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p class="text-primary"><strong>Date de Naissance:</strong> {{ $eleve->date_naissance }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    @if($eleve->image)
                        <img src="{{ Storage::url($eleve->image) }}" alt="Photo de Profil" class="img-fluid rounded-circle" style="max-width: 250px; max-height: 250px; object-fit: cover;">
                    @else
                        <img src="{{ asset('default-profile.png') }}" alt="Photo de Profil par défaut" class="img-fluid rounded-circle" style="max-width: 250px; max-height: 250px; object-fit: cover;">
                    @endif
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('eleves.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la Liste
                </a>
                <a href="{{ route('eleves.edit', $eleve->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
