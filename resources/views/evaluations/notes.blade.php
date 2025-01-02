@extends('layouts.app')

@section('title', 'Notes de l\'Évaluation')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clipboard-list me-3"></i>
                            <h2 class="mb-0">Notes de l'Évaluation: {{ $evaluation->titre }}</h2>
                        </div>
                        <div>
                            <span class="badge bg-light text-dark me-2">
                                <i class="fas fa-book me-2"></i>{{ $evaluation->module->nom }}
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-primary">
                                            <i class="fas fa-user me-2"></i>Étudiant
                                        </th>
                                        <th class="text-primary text-center">
                                            <i class="fas fa-hashtag me-2"></i>Numéro Étudiant
                                        </th>
                                        <th class="text-primary text-center">
                                            <i class="fas fa-chart-bar me-2"></i>Note
                                        </th>
                                        <th class="text-primary text-center">
                                            <i class="fas fa-cogs me-2"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($evaluation->evaluationEleves as $evaluationEleve)
                                        <tr class="align-middle">
                                            <td>{{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }}</td>
                                            <td class="text-center">{{ $evaluationEleve->eleve->numero_etudiant }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $evaluationEleve->note >= 10 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ number_format($evaluationEleve->note, 2) }}/20
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('evaluationEleves.edit', ['evaluationEleve' => $evaluationEleve]) }}" 
                                                       class="btn btn-sm btn-warning text-white" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Modifier la Note">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('evaluationEleves.destroy', $evaluationEleve) }}" 
                                                          method="POST" 
                                                          class="d-inline" 
                                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette note ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger text-white" 
                                                                data-bs-toggle="tooltip" 
                                                                title="Supprimer">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="fas fa-info-circle me-2"></i>Aucune note saisie pour cette évaluation
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div>
                            <span class="me-3">
                                <strong>Moyenne:</strong> 
                                <span class="badge bg-light text-dark">
                                    {{ $evaluation->evaluationEleves->count() > 0 ? number_format($averageNote, 2) : 'N/A' }}/20
                                </span>
                            </span>
                            <span>
                                <strong>Coefficient:</strong> {{ $evaluation->coefficient }}
                            </span>
                        </div>
                        <div>
                            <a href="{{ route('evaluationEleves.create', $evaluation) }}" 
                               class="btn btn-primary text-white">
                                <i class="fas fa-plus-circle me-2"></i>Ajouter des Notes
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>Statistiques de l'Évaluation
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="alert alert-info">
                                    <strong><i class="fas fa-chart-bar me-2"></i>Notes:</strong>
                                    Min: {{ number_format($minNote, 2) }} | 
                                    Max: {{ number_format($maxNote, 2) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-warning">
                                    <strong><i class="fas fa-users me-2"></i>Étudiants:</strong>
                                    Total: {{ $totalStudents }} | 
                                    Admis: {{ $passedStudents }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-success">
                                    <strong><i class="fas fa-percent me-2"></i>Taux de Réussite:</strong>
                                    {{ number_format($passRate, 2) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
