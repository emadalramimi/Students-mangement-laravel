<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Models\Module;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Allow both teachers and students to view evaluations
        $evaluations = Evaluation::with('module')->paginate(10);
        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Only teachers can create evaluations
        $this->authorize('gerer-evaluations');

        $moduleId = $request->query('module_id'); 
        $modules = Module::all(); 
        $selectedModule = $moduleId ? Module::findOrFail($moduleId) : null;
        return view('evaluations.create', compact('modules', 'selectedModule'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only teachers can store evaluations
        $this->authorize('gerer-evaluations');

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'module_id' => 'required|exists:modules,id',
            'date' => 'required|date',
            'coefficient' => 'required|integer|min:1',
        ]);

        Evaluation::create($validated);

        return redirect()->route('evaluations.index')->with('success', 'Évaluation ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        // Both teachers and students can view evaluation details
        return view('evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        // Only teachers can edit evaluations
        $this->authorize('gerer-evaluations');

        $modules = Module::all(); // Fetch all modules for the dropdown
        return view('evaluations.edit', compact('evaluation', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        // Only teachers can update evaluations
        $this->authorize('gerer-evaluations');

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'module_id' => 'required|exists:modules,id',
            'date' => 'required|date',
            'coefficient' => 'required|integer|min:1',
        ]);

        $evaluation->update($validated);

        return redirect()->route('evaluations.index')->with('success', 'Évaluation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        // Only teachers can delete evaluations
        $this->authorize('gerer-evaluations');

        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès.');
    }


    /**
     * Display students below average for a specific evaluation.
     */
    public function belowAverage($id)
    {
        $evaluation = Evaluation::with(['evaluationEleves.eleve'])->findOrFail($id);
        
        $evaluationEleves = $evaluation->evaluationEleves;
        $totalStudents = $evaluationEleves->count();
        
        // Calculate average note
        $averageNote = $evaluationEleves->avg('note') ?? 0;
        
        // Filter below average notes
        $belowAverageNotes = $evaluationEleves->filter(fn($evaluationEleve) => $evaluationEleve->note < 10);
        
        // Calculate additional statistics
        $minNote = $evaluationEleves->min('note') ?? 0;
        $maxNote = $evaluationEleves->max('note') ?? 0;
        
        return view('evaluations.below-average', compact(
            'evaluation', 
            'belowAverageNotes', 
            'averageNote', 
            'totalStudents', 
            'minNote', 
            'maxNote'
        ));
    }

    public function notes($id)
    {
        $evaluation = Evaluation::with(['evaluationEleves.eleve', 'module'])->findOrFail($id);
        
        $evaluationEleves = $evaluation->evaluationEleves;
        
        // Calculate average note
        $averageNote = $evaluationEleves->avg('note') ?? 0;
        
        // Calculate additional statistics
        $minNote = $evaluationEleves->min('note') ?? 0;
        $maxNote = $evaluationEleves->max('note') ?? 0;
        $totalStudents = $evaluationEleves->count();
        $passedStudents = $evaluationEleves->filter(fn($evaluationEleve) => $evaluationEleve->note >= 10)->count();
        $passRate = $totalStudents > 0 ? ($passedStudents / $totalStudents * 100) : 0;
        
        return view('evaluations.notes', compact(
            'evaluation', 
            'averageNote', 
            'minNote', 
            'maxNote', 
            'totalStudents', 
            'passedStudents', 
            'passRate'
        ));
    }
}
