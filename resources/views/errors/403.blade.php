@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">{{ __('Accès non autorisé') }}</h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-lock fa-5x text-danger mb-4"></i>
                        <h2 class="mb-3">{{ __('Accès refusé') }}</h2>
                        <p class="lead">
                            {{ __('Vous n\'avez pas la permission d\'accéder à cette page.') }}
                        </p>
                        <p>
                            {{ __('Seuls les utilisateurs autorisés peuvent effectuer cette action.') }}
                        </p>
                    </div>
                    
                    <hr>
                    
                    <div class="text-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> {{ __('Retour au tableau de bord') }}
                        </a>
                        @if(auth()->check())
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-user"></i> {{ __('Mon profil') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Se connecter') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-header.bg-danger {
        background-color: #dc3545 !important;
    }
</style>
@endpush
