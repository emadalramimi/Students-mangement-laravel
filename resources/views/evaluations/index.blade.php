@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ __('Liste des Évaluations') }}</h3>
                    @can('gerer-evaluations')
                    <a href="{{ route('evaluations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> {{ __('Nouvelle Évaluation') }}
                    </a>
                    @endcan
                </div>

                <div class="card-body">
                    @if($evaluations->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucune évaluation n\'a été trouvée.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Titre') }}</th>
                                        <th>{{ __('Module') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Coefficient') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluations as $evaluation)
                                    <tr>
                                        <td>{{ $evaluation->titre }}</td>
                                        <td>{{ $evaluation->module->nom }}</td>
                                        <td>{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}</td>
                                        <td>{{ $evaluation->coefficient }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('evaluations.show', $evaluation) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @can('gerer-evaluations')
                                                <a href="{{ route('evaluations.edit', $evaluation) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('evaluations.destroy', $evaluation) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('{{ __('Voulez-vous vraiment supprimer cette évaluation ?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            {{ $evaluations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
