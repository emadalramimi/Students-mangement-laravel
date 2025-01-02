@extends('layouts.app')

@section('title', 'Modifier un Élève')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">
                <i class="fas fa-user-edit me-2"></i>Modifier l'Élève
            </h2>
            <a href="{{ route('eleves.show', $eleve) }}" class="btn btn-light text-primary">
                <i class="fas fa-eye me-2"></i>Profil
            </a>
        </div>
        <div class="card-body p-5">
            <form action="{{ route('eleves.update', $eleve) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="nom" class="form-label">Nom:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" 
                                   name="nom" 
                                   id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   value="{{ old('nom', $eleve->nom) }}" 
                                   required 
                                   pattern="[A-Za-zÀ-ÿ\s-]+"
                                   title="Seules les lettres, espaces et traits d'union sont autorisés">
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="prenom" class="form-label">Prénom:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" 
                                   name="prenom" 
                                   id="prenom" 
                                   class="form-control @error('prenom') is-invalid @enderror" 
                                   value="{{ old('prenom', $eleve->prenom) }}" 
                                   required 
                                   pattern="[A-Za-zÀ-ÿ\s-]+"
                                   title="Seules les lettres, espaces et traits d'union sont autorisés">
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="date_naissance" class="form-label">Date de Naissance:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" 
                                   name="date_naissance" 
                                   id="date_naissance" 
                                   class="form-control @error('date_naissance') is-invalid @enderror" 
                                   value="{{ old('date_naissance', $eleve->date_naissance) }}" 
                                   required 
                                   max="{{ now()->subYears(16)->format('Y-m-d') }}"
                                   title="Vous devez avoir au moins 16 ans">
                            @error('date_naissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="numero_etudiant" class="form-label">Numéro Étudiant:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" 
                                   name="numero_etudiant" 
                                   id="numero_etudiant" 
                                   class="form-control @error('numero_etudiant') is-invalid @enderror" 
                                   value="{{ old('numero_etudiant', $eleve->numero_etudiant) }}" 
                                   required 
                                   pattern="\d{8}"
                                   title="Le numéro étudiant doit contenir 8 chiffres">
                            @error('numero_etudiant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $eleve->email) }}" 
                               required 
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               title="Veuillez entrer une adresse email valide">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Photo:</label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*"
                           max-file-size="5120">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($eleve->image)
                        <div class="mt-2">
                            <small class="text-muted">Image actuelle: 
                                <a href="{{ asset('storage/' . $eleve->image) }}" 
                                   target="_blank" 
                                   class="text-primary">
                                    <i class="fas fa-image me-2"></i>Voir l'image
                                </a>
                            </small>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                        <i class="fas fa-save me-2"></i>Mettre à Jour
                    </button>
                    <a href="{{ route('eleves.index') }}" class="btn btn-outline-secondary btn-lg px-5 shadow-sm">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
