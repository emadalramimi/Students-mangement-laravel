@extends('layouts.app')

@section('title', 'Détails du Module')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-book me-3"></i>
                    <h2 class="mb-0">Détails du Module: {{ $module->nom }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-primary">
                                    <i class="fas fa-code me-2"></i>Code du Module
                                </label>
                                <div class="alert alert-light" role="alert">
                                    {{ $module->code }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-primary">
                                    <i class="fas fa-percent me-2"></i>Coefficient
                                </label>
                                <div class="alert alert-light" role="alert">
                                    {{ $module->coefficient }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-list me-2"></i>Évaluations du Module
                            </h4>
                            <a href="{{ route('evaluations.create', ['module_id' => $module->id]) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Ajouter une Évaluation
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Titre</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Coefficient</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($module->evaluations as $evaluation)
                                            <tr>
                                                <td>{{ $evaluation->titre }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-center">{{ $evaluation->coefficient }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('evaluations.notes', $evaluation->id) }}" 
                                                           class="btn btn-sm btn-info" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Voir les Notes">
                                                            <i class="fas fa-chart-bar"></i>
                                                        </a>
                                                        <a href="{{ route('evaluations.edit', $evaluation->id) }}" 
                                                           class="btn btn-sm btn-warning" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-danger" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#deleteModal{{ $evaluation->id }}"
                                                                title="Supprimer">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $evaluation->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h5 class="modal-title">Confirmer la suppression</h5>
                                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-start">
                                                                    Voulez-vous vraiment supprimer l'évaluation "{{ $evaluation->titre }}" ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="fas fa-trash me-2"></i>Supprimer
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">
                                                    Aucune évaluation pour ce module
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('modules.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la Liste
                        </a>
                        <div>
                            <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-warning me-2 text-white">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                            <form action="{{ route('modules.destroy', $module->id) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce module ?');">
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
        </div>
    </div>
</div>
@endsection
