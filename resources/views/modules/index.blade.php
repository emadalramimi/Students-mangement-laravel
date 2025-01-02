@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ __('Liste des Modules') }}</h3>
                    @can('gerer-modules')
                    <a href="{{ route('modules.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> {{ __('Nouveau Module') }}
                    </a>
                    @endcan
                </div>

                <div class="card-body">
                    @if($modules->isEmpty())
                        <div class="alert alert-info">
                            {{ __('Aucun module n\'a été trouvé.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $module)
                                    <tr>
                                        <td>{{ $module->nom }}</td>
                                        <td>{{ Str::limit($module->description, 100) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('modules.show', $module) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @can('gerer-modules')
                                                <a href="{{ route('modules.edit', $module) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('modules.destroy', $module) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('{{ __('Voulez-vous vraiment supprimer ce module ?') }}');">
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
                            {{ $modules->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
