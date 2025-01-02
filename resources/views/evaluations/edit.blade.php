@extends('layouts.app')

@section('title', 'Modifier une Évaluation')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Modifier l'Évaluation
                    </h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('evaluations.update', $evaluation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Titre -->
                            <div class="col-md-12 mb-3">
                                <label for="titre" class="form-label">
                                    <i class="fas fa-heading me-1"></i>Titre de l'Évaluation
                                </label>
                                <input type="text" 
                                       name="titre" 
                                       id="titre" 
                                       class="form-control @error('titre') is-invalid @enderror" 
                                       value="{{ old('titre', $evaluation->titre) }}" 
                                       required
                                       placeholder="Entrez le titre de l'évaluation">
                                @error('titre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Module -->
                            <div class="col-md-12 mb-3">
                                <label for="module_id" class="form-label">
                                    <i class="fas fa-book me-1"></i>Module
                                </label>
                                <select name="module_id" 
                                        id="module_id" 
                                        class="form-select @error('module_id') is-invalid @enderror" 
                                        required>
                                    <option value="">Sélectionnez un module</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}" 
                                                {{ old('module_id', $evaluation->module_id) == $module->id ? 'selected' : '' }}>
                                            {{ $module->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('module_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Date
                                </label>
                                <input type="date" 
                                       name="date" 
                                       id="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       value="{{ old('date', $evaluation->date) }}" 
                                       required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Coefficient -->
                            <div class="col-md-6 mb-3">
                                <label for="coefficient" class="form-label">
                                    <i class="fas fa-percentage me-1"></i>Coefficient
                                </label>
                                <input type="number" 
                                       name="coefficient" 
                                       id="coefficient" 
                                       class="form-control @error('coefficient') is-invalid @enderror" 
                                       value="{{ old('coefficient', $evaluation->coefficient) }}" 
                                       min="1"
                                       max="10"
                                       step="0.5"
                                       required>
                                @error('coefficient')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Le coefficient doit être compris entre 1 et 10
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-success text-white">
                                <i class="fas fa-save me-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Card -->
            <div class="card mt-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Zone Dangereuse
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-danger">Supprimer l'Évaluation</h6>
                    <p class="card-text">
                        Cette action est irréversible et supprimera toutes les notes associées à cette évaluation.
                    </p>
                    <button type="button" 
                            class="btn btn-outline-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>Supprimer l'Évaluation
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmer la Suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer l'évaluation "{{ $evaluation->titre }}" ?</p>
                <p class="text-danger mb-0 mt-2">
                    <strong>Attention:</strong> Cette action est irréversible et supprimera également toutes les notes associées.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Annuler
                </button>
                <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-white">
                        <i class="fas fa-trash me-2"></i>Supprimer Définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
