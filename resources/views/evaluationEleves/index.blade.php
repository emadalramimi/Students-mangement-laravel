@extends('layouts.app')

@section('title', 'Liste des Notes')

@section('content')
<div class="container py-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="page-title d-flex align-items-center">
                <i class="fas fa-chart-bar me-3 text-primary"></i>Liste des Notes
            </h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('evaluationEleves.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Ajouter des Notes
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-primary">
                                <i class="fas fa-user me-2"></i>Étudiant
                            </th>
                            <th class="text-primary">
                                <i class="fas fa-book me-2"></i>Évaluation
                            </th>
                            <th class="text-primary">
                                <i class="fas fa-module me-2"></i>Module
                            </th>
                            <th class="text-primary text-center">
                                <i class="fas fa-percent me-2"></i>Note
                            </th>
                            <th class="text-primary text-center">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notes as $note)
                            <tr class="align-middle">
                                <td>{{ $note->eleve->nom }} {{ $note->eleve->prenom }}</td>
                                <td>{{ $note->evaluation->titre }}</td>
                                <td>{{ $note->evaluation->module->nom }}</td>
                                <td class="text-center">{{ number_format($note->valeur, 2) }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('evaluationEleves.edit', $note->id) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           data-bs-toggle="tooltip" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('evaluationEleves.destroy', $note->id) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cette note ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i>Aucune note trouvée
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $notes->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
