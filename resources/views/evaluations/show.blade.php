@extends('layouts.app')

@section('title', 'Détails de l\'Évaluation')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 mb-0">{{ $evaluation->titre }}</h1>
            <p class="text-muted lead">{{ $evaluation->module->nom }}</p>
        </div>
        <div class="col-md-4 text-md-end d-flex align-items-center justify-content-md-end">
            <div class="btn-group">
                <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash me-2"></i>Supprimer
                </button>
            </div>
        </div>
    </div>

    <!-- Info Cards Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Date</h6>
                    <p class="card-text h4">{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Coefficient</h6>
                    <p class="card-text h4">{{ $evaluation->coefficient }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Moyenne</h6>
                    <p class="card-text h4">{{ number_format($evaluation->evaluationEleves->avg('note'), 2) }}/20</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Étudiants Évalués</h6>
                    <p class="card-text h4">{{ $evaluation->evaluationEleves->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Actions Rapides</h5>
                    <div class="btn-group">
                        <a href="{{ route('evaluations.notes', $evaluation) }}" class="btn btn-success text-white">
                            <i class="fas fa-chart-line me-2"></i>Voir les Notes
                        </a>
                        <a href="{{ route('evaluationEleves.create', $evaluation) }}" class="btn btn-primary text-white">
                            <i class="fas fa-plus me-2"></i>Ajouter des Notes
                        </a>
                        <a href="{{ route('evaluations.belowAverage', $evaluation) }}" class="btn btn-info text-white">
                            <i class="fas fa-chart-bar me-2"></i>Étudiants < 10
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">Notes des Étudiants</h5>
        </div>
        <div class="card-body">
            @if($evaluation->evaluationEleves->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Étudiant</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evaluation->evaluationEleves as $evaluationEleve)
                                <tr>
                                    <td>{{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }}</td>
                                    <td>{{ $evaluationEleve->note }}/20</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('evaluationEleves.edit', $evaluationEleve) }}" 
                                               class="btn btn-sm btn-warning text-white"
                                               data-bs-toggle="tooltip"
                                               title="Modifier la note">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteNoteModal{{ $evaluationEleve->id }}"
                                                    title="Supprimer la note">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Note Modal -->
                                        <div class="modal fade" id="deleteNoteModal{{ $evaluationEleve->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez-vous vraiment supprimer la note de {{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('evaluationEleves.destroy', $evaluationEleve) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger text-white">
                                                                <i class="fas fa-trash me-2"></i>Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted mb-0">Aucune note n'a encore été ajoutée pour cette évaluation.</p>
                    <a href="{{ route('evaluationEleves.create', $evaluation) }}" class="btn btn-primary text-white">
                        <i class="fas fa-plus me-2"></i>Ajouter des Notes
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Evaluation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer l'évaluation "{{ $evaluation->titre }}" ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>
</div>
@endsection
