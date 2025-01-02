@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tableau de bord - Élève') }}</div>

                <div class="card-body">
                    <h2>{{ __('Bienvenue') }}, {{ $user->name }}!</h2>
                    
                    <div class="alert alert-info">
                        {{ __('Vous êtes connecté en tant qu\'élève.') }}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">{{ __('Mes informations') }}</div>
                                <div class="card-body">
                                    <p><strong>{{ __('Nom') }}:</strong> {{ $user->name }}</p>
                                    <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">{{ __('Mes modules') }}</div>
                                <div class="card-body">
                                    <p>{{ __('Aucun module n\'est actuellement disponible.') }}</p>
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
