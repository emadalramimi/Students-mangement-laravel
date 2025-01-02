@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card animate-fade-in">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-plus me-3"></i>
                    <h2 class="mb-0">Ajouter un Élève</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('eleves.store') }}" enctype="multipart/form-data" 
                          class="needs-validation" 
                          novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-primary">Nom *</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                                    <input type="text" name="nom" 
                                           class="form-control @error('nom') is-invalid @enderror" 
                                           value="{{ old('nom') }}"
                                           required 
                                           placeholder="Entrez le nom"
                                           data-bs-toggle="tooltip" 
                                           title="Nom de famille de l'élève">
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-primary">Prénom *</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                                    <input type="text" name="prenom" 
                                           class="form-control @error('prenom') is-invalid @enderror" 
                                           value="{{ old('prenom') }}"
                                           required 
                                           placeholder="Entrez le prénom"
                                           data-bs-toggle="tooltip" 
                                           title="Prénom de l'élève">
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-primary">Numéro Étudiant *</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-id-card"></i></span>
                                    <input type="text" name="numero_etudiant" 
                                           class="form-control @error('numero_etudiant') is-invalid @enderror" 
                                           value="{{ old('numero_etudiant') }}"
                                           required 
                                           placeholder="Ex: S2023001"
                                           data-bs-toggle="tooltip" 
                                           title="Numéro unique d'identification">
                                    @error('numero_etudiant')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label text-primary">Email *</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}"
                                           required 
                                           placeholder="nom.prenom@example.com"
                                           data-bs-toggle="tooltip" 
                                           title="Adresse email valide">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Photo de Profil</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept=".jpg,.jpeg,.png,.gif">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('eleves.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à la Liste
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
