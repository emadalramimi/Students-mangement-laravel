@extends('layouts.app')

@section('title', 'Notes de l\'Étudiant')

@section('content')
    <h1>Notes de l'Étudiant: {{ $eleve->nom }} {{ $eleve->prenom }}</h1>
    <p><strong>Moyenne:</strong> {{ round($average, 2) }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Évaluation</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eleve->evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->evaluation->titre }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('eleves.index') }}" class="btn btn-secondary">Retour</a>
@endsection
