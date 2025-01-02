@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @can('modifier-profil', $user)
            <div class="card">
                <div class="card-header">{{ __('Modifier le Profil') }}</div>

                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">{{ __('Modifier le Mot de Passe') }}</div>

                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header text-danger">{{ __('Supprimer le Compte') }}</div>

                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                {{ __('Vous n\'êtes pas autorisé à modifier ce profil.') }}
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
