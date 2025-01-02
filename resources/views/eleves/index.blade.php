@extends('layouts.app')

@section('title', 'Liste des Étudiants')

@section('content')
<div class="container py-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="page-title d-flex align-items-center">
                <i class="fas fa-users me-3 text-primary"></i>Liste des Étudiants
            </h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('eleves.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus me-2"></i>Ajouter un Étudiant
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
                                <i class="fas fa-hashtag me-2"></i>#
                            </th>
                            <th class="text-primary">
                                <i class="fas fa-user me-2"></i>Nom
                            </th>
                            <th class="text-primary">
                                <i class="fas fa-envelope me-2"></i>Email
                            </th>
                            <th class="text-primary text-center">
                                <i class="fas fa-birthday-cake me-2"></i>Date de Naissance
                            </th>
                            <th class="text-primary text-center">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eleves as $eleve)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                                <td>{{ $eleve->email }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('eleves.show', $eleve->id) }}" 
                                           class="btn btn-sm btn-info" 
                                           data-bs-toggle="tooltip" 
                                           title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('eleves.notes', $eleve->id) }}" 
                                           class="btn btn-sm btn-success" 
                                           data-bs-toggle="tooltip" 
                                           title="Voir les notes">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                                        <a href="{{ route('eleves.edit', $eleve->id) }}" 
                                           class="btn btn-sm btn-warning" 
                                           data-bs-toggle="tooltip" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $eleve->id }}"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $eleve->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    Voulez-vous vraiment supprimer l'étudiant "{{ $eleve->nom }} {{ $eleve->prenom }}" ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('eleves.destroy', $eleve->id) }}" method="POST" class="d-inline">
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i>Aucun étudiant trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $eleves->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
