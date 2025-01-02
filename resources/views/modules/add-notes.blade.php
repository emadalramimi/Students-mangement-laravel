@extends('layouts.app')

@section('title', 'Ajouter des Notes')

@section('content')
    <h1>Ajouter des Notes pour le Module: {{ $module->nom }}</h1>
    <form action="{{ route('modules.save.notes', $module->id) }}" method="POST">
        @csrf
        <div>
            <label for="evaluation_id">Évaluation:</label>
            <select name="evaluation_id" id="evaluation_id" required>
                @foreach ($module->evaluations as $evaluation)
                    <option value="{{ $evaluation->id }}">{{ $evaluation->titre }}</option>
                @endforeach
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Numéro Étudiant</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eleves as $eleve)
                    <tr>
                        <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                        <td>{{ $eleve->numero_etudiant }}</td>
                        <td>
                            <input type="hidden" name="notes[{{ $loop->index }}][eleve_id]" value="{{ $eleve->id }}">
                            <input type="number" name="notes[{{ $loop->index }}][note]" min="0" max="20" step="0.1">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Enregistrer les Notes</button>
    </form>
@endsection
