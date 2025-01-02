@extends('layouts.app')

@section('title', 'Créer une Évaluation')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-clipboard-list me-3"></i>
                    <h2 class="mb-0">Créer une Nouvelle Évaluation</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('evaluations.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="module_id" class="form-label">
                                    <i class="fas fa-book me-2 text-primary"></i>Module
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                                    <select 
                                        class="form-select @error('module_id') is-invalid @enderror" 
                                        id="module_id" 
                                        name="module_id" 
                                        required
                                        data-bs-toggle="tooltip"
                                        title="Sélectionnez le module correspondant">
                                        <option value="">Choisir un Module</option>
                                        @foreach($modules as $module)
                                            <option 
                                                value="{{ $module->id }}"
                                                {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                                {{ $module->nom }} ({{ $module->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('module_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="coefficient" class="form-label">
                                    <i class="fas fa-percent me-2 text-primary"></i>Coefficient
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                    <input type="number" 
                                           class="form-control @error('coefficient') is-invalid @enderror" 
                                           id="coefficient" 
                                           name="coefficient" 
                                           value="{{ old('coefficient') }}"
                                           min="1" 
                                           max="5" 
                                           step="0.5"
                                           required
                                           data-bs-toggle="tooltip"
                                           title="Coefficient entre 1 et 5">
                                    @error('coefficient')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="titre" class="form-label">
                                    <i class="fas fa-heading me-2 text-primary"></i>Titre de l'Évaluation
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    <input type="text" 
                                           class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" 
                                           name="titre" 
                                           value="{{ old('titre') }}"
                                           required
                                           minlength="3"
                                           data-bs-toggle="tooltip"
                                           title="Titre descriptif de l'évaluation">
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label">
                                    <i class="fas fa-calendar me-2 text-primary"></i>Date de l'Évaluation
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ old('date') }}"
                                           required
                                           data-bs-toggle="tooltip"
                                           title="Date de l'évaluation">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à la Liste
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Créer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
