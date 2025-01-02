@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="container py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="display-4 mb-2">Bienvenue sur votre Tableau de Bord</h2>
                            <p class="lead mb-0">Gérez facilement vos étudiants, modules et évaluations</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <i class="fas fa-graduation-cap fa-4x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2">Étudiants</h6>
                            <h2 class="mb-0">{{ $totalEleves ?? 0 }}</h2>
                        </div>
                        <div class="icon-shape">
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('eleves.index') }}" class="text-white text-decoration-none">
                            Voir tous <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2">Modules</h6>
                            <h2 class="mb-0">{{ $totalModules ?? 0 }}</h2>
                        </div>
                        <div class="icon-shape">
                            <i class="fas fa-book fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('modules.index') }}" class="text-white text-decoration-none">
                            Voir tous <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2">Évaluations</h6>
                            <h2 class="mb-0">{{ $totalEvaluations ?? 0 }}</h2>
                        </div>
                        <div class="icon-shape">
                            <i class="fas fa-clipboard-list fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('evaluations.index') }}" class="text-white text-decoration-none">
                            Voir toutes <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2">Moyenne Générale</h6>
                            <h2 class="mb-0">{{ number_format($moyenneGenerale ?? 0, 2) }}/20</h2>
                        </div>
                        <div class="icon-shape">
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-white opacity-75">
                            Toutes évaluations confondues
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Prochaines Évaluations
                    </h5>
                </div>
                <div class="card-body">
                    @if(isset($prochaines_evaluations) && count($prochaines_evaluations) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($prochaines_evaluations as $evaluation)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $evaluation->titre }}</h6>
                                            <small class="text-muted">
                                                {{ $evaluation->module->nom }} | Coef. {{ $evaluation->coefficient }}
                                            </small>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary">
                                                {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">Aucune évaluation à venir</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistiques par Module
                    </h5>
                </div>
                <div class="card-body">
                    @if(isset($stats_modules) && count($stats_modules) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($stats_modules as $stat)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $stat->module_nom }}</h6>
                                            <div class="progress" style="height: 5px; width: 200px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: {{ ($stat->moyenne / 20) * 100 }}%"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-success">
                                                {{ number_format($stat->moyenne, 2) }}/20
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">Aucune statistique disponible</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-shape {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,.05);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.progress {
    background-color: rgba(0,0,0,.1);
}

.progress-bar {
    background-color: #26A69A;
}

.bg-primary {
    background-color: #26A69A !important;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}
</style>
@endsection
