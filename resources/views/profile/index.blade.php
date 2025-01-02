@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mon Profil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <img src="{{ asset('images/default-avatar.png') }}" 
                                 alt="{{ $user->name }}" 
                                 class="img-fluid rounded-circle mb-3"
                                 style="max-width: 200px;">
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $user->name }}</h2>
                            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                            <p><strong>{{ __('Rôle') }}:</strong> 
                                {{ $user->role === 'eleve' ? 'Élève' : 'Enseignant' }}
                            </p>
                            <p><strong>{{ __('Date d\'inscription') }}:</strong> 
                                {{ $user->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> {{ __('Modifier mon profil') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
