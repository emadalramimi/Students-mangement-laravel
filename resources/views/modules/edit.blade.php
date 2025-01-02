@extends('layouts.app')

@section('title', 'Modifier un Module')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-edit me-3"></i>
                    <h2 class="mb-0">Modifier le Module: {{ $module->nom }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('modules.update', $module->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="code" class="form-label text-primary">
                                    <i class="fas fa-code me-2"></i>Code du Module
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-tag"></i></span>
                                    <input type="text" 
                                           class="form-control @error('code') is-invalid @enderror" 
                                           id="code" 
                                           name="code" 
                                           value="{{ old('code', $module->code) }}"
                                           required
                                           pattern="[A-Z0-9]+"
                                           data-bs-toggle="tooltip"
                                           title="Code unique en majuscules et chiffres">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="coefficient" class="form-label text-primary">
                                    <i class="fas fa-percent me-2"></i>Coefficient
                                </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-primary text-white"><i class="fas fa-balance-scale"></i></span>
                                    <input type="number" 
                                           class="form-control @error('coefficient') is-invalid @enderror" 
                                           id="coefficient" 
                                           name="coefficient" 
                                           value="{{ old('coefficient', $module->coefficient) }}"
                                           min="1" 
                                           max="10" 
                                           step="0.5"
                                           required
                                           data-bs-toggle="tooltip"
                                           title="Coefficient entre 1 et 10">
                                    @error('coefficient')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nom" class="form-label text-primary">
                                <i class="fas fa-book-open me-2"></i>Nom du Module
                            </label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-heading"></i></span>
                                <input type="text" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" 
                                       name="nom" 
                                       value="{{ old('nom', $module->nom) }}"
                                       required
                                       minlength="3"
                                       data-bs-toggle="tooltip"
                                       title="Nom descriptif du module">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('modules.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à la Liste
                            </a>
                            <button type="submit" class="btn btn-primary text-white">
                                <i class="fas fa-save me-2"></i>Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
