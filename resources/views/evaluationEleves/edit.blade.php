@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier la Note
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluationEleves.update', $evaluationEleve) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">Détails de l'Étudiant</div>
                            <div class="card-body">
                                <p><strong>Nom:</strong> {{ $eleve->nom }} {{ $eleve->prenom }}</p>
                                <p><strong>Numéro Étudiant:</strong> {{ $eleve->numero_etudiant }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">Détails de l'Évaluation</div>
                            <div class="card-body">
                                <p><strong>Titre:</strong> {{ $evaluation->titre }}</p>
                                <p><strong>Date:</strong> {{ $evaluation->date }}</p>
                                <p><strong>Coefficient:</strong> {{ $evaluation->coefficient }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="note" class="form-label">Note</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                        <input type="number" 
                               class="form-control @error('note') is-invalid @enderror" 
                               id="note" 
                               name="note" 
                               min="0" 
                               max="20" 
                               step="0.01" 
                               value="{{ old('note', $evaluationEleve->note) }}"
                               required>
                        <span class="input-group-text">/20</span>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">Entrez une note entre 0 et 20</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('evaluations.notes', $evaluation) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux Notes
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer la Note
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
