@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Tableau de bord - Enseignant') }}</div>

                <div class="card-body">
                    <h2>{{ __('Bienvenue') }}, {{ $user->name }}!</h2>
                    
                    <div class="alert alert-info">
                        {{ __('Vous êtes connecté en tant qu\'enseignant.') }}
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">{{ __('Mes informations') }}</div>
                                <div class="card-body">
                                    <p><strong>{{ __('Nom') }}:</strong> {{ $user->name }}</p>
                                    <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">{{ __('Modules') }}</div>
                                <div class="card-body">
                                    <a href="{{ route('modules.index') }}" class="btn btn-primary w-100">
                                        {{ __('Gérer les modules') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">{{ __('Évaluations') }}</div>
                                <div class="card-body">
                                    <a href="{{ route('evaluations.index') }}" class="btn btn-success w-100">
                                        {{ __('Gérer les évaluations') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
