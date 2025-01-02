<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ModuleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifier si l'utilisateur a le droit de gérer les modules
        $this->authorize('gerer-modules');

        // Retrieve all modules with pagination
        $modules = Module::paginate(10);
        return view('modules.index', compact('modules'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('gerer-modules');
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('gerer-modules');
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Module::create($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $module = Module::with('evaluations')->findOrFail($id); // Fetch module with related evaluations
        return view('modules.show', compact('module'));
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        $this->authorize('gerer-modules');
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $this->authorize('gerer-modules');
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module->update($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $this->authorize('gerer-modules');
        
        $module->delete();

        return redirect()->route('modules.index')
            ->with('success', 'Module supprimé avec succès.');
    }
}
