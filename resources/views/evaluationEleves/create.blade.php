@extends('layouts.app')

@section('title', 'Ajouter des Notes')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 mb-0">Ajouter des Notes</h1>
            <p class="text-muted lead">{{ $evaluation->titre }}</p>
            <p class="text-muted">
                <i class="fas fa-book me-2"></i>{{ $evaluation->module->nom }} |
                <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }} |
                <i class="fas fa-percentage me-2"></i>Coefficient: {{ $evaluation->coefficient }}
            </p>
        </div>
        <div class="col-md-4 text-md-end d-flex align-items-center justify-content-md-end">
            <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>Liste des Étudiants
                    </h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               id="searchInput" 
                               placeholder="Rechercher un étudiant...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('evaluationEleves.store', $evaluation->id) }}" method="POST" id="notesForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="studentsTable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Étudiant</th>
                                <th class="border-0">Numéro Étudiant</th>
                                <th class="border-0" style="width: 200px;">Note /20</th>
                                <th class="border-0" style="width: 200px;">Justificatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eleves as $eleve)
                                @php
                                    $existingNote = $evaluation->evaluationEleves->firstWhere('eleve_id', $eleve->id);
                                @endphp
                                <tr class="student-row">
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initials me-3">
                                                {{ strtoupper(substr($eleve->prenom, 0, 1) . substr($eleve->nom, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="student-name">{{ $eleve->nom }} {{ $eleve->prenom }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle student-number">{{ $eleve->numero_etudiant }}</td>
                                    <td class="align-middle">
                                        <input type="hidden" name="eleve_ids[]" value="{{ $eleve->id }}">
                                        <div class="input-group">
                                            <input type="number" 
                                                   class="form-control note-input @error('notes.' . $loop->index) is-invalid @enderror"
                                                   name="notes[]" 
                                                   min="0" 
                                                   max="20" 
                                                   step="0.5"
                                                   value="{{ old('notes.' . $loop->index, $existingNote ? $existingNote->note : '') }}"
                                                   placeholder="Note"
                                            >
                                            <input type="file" 
                                                   class="form-control @error('justificatifs.' . $loop->index) is-invalid @enderror" 
                                                   name="justificatifs[]"
                                                   accept=".jpg,.jpeg,.png,.pdf"
                                            >
                                            @error('justificatifs.' . $loop->index)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top p-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text-muted">
                                <span id="notesCount">0</span> notes saisies sur {{ $eleves->count() }} étudiants
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <button type="button" class="btn btn-secondary me-2" id="resetButton">
                                <i class="fas fa-undo me-2"></i>Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-success text-white">
                                <i class="fas fa-save me-2"></i>Enregistrer les Notes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.avatar-initials {
    width: 40px;
    height: 40px;
    background-color: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #495057;
}

.note-input::-webkit-inner-spin-button,
.note-input::-webkit-outer-spin-button {
    opacity: 1;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('.student-row');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        rows.forEach(row => {
            const name = row.querySelector('.student-name').textContent.toLowerCase();
            const number = row.querySelector('.student-number').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || number.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Notes counter
    function updateNotesCount() {
        const filledNotes = document.querySelectorAll('.note-input[value]:not([value=""])').length;
        document.getElementById('notesCount').textContent = filledNotes;
    }

    // Initialize notes count
    updateNotesCount();

    // Update count when notes change
    document.querySelectorAll('.note-input').forEach(input => {
        input.addEventListener('input', updateNotesCount);
    });

    // Reset button
    document.getElementById('resetButton').addEventListener('click', function() {
        if (confirm('Voulez-vous vraiment réinitialiser toutes les notes ?')) {
            document.querySelectorAll('.note-input').forEach(input => {
                input.value = '';
            });
            updateNotesCount();
        }
    });

    // Form validation
    document.getElementById('notesForm').addEventListener('submit', function(e) {
        const inputs = document.querySelectorAll('.note-input');
        let hasInvalidNote = false;

        inputs.forEach(input => {
            const value = parseFloat(input.value);
            if (input.value && (isNaN(value) || value < 0 || value > 20)) {
                hasInvalidNote = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (hasInvalidNote) {
            e.preventDefault();
            alert('Veuillez corriger les notes invalides (entre 0 et 20)');
        }
    });
});
</script>
@endpush
@endsection
