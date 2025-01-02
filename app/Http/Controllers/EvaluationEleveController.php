<?php

namespace App\Http\Controllers;

use App\Models\EvaluationEleve;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Eleve;

class EvaluationEleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Les élèves peuvent voir leurs propres notes, mais pas gérer les évaluations
        $eleve = auth()->user()->eleve;
        
        // Récupérer les notes de l'élève
        $evaluationEleves = EvaluationEleve::whereHas('evaluation', function($query) use ($eleve) {
            $query->whereHas('module', function($moduleQuery) use ($eleve) {
                $moduleQuery->whereHas('eleves', function($eleveQuery) use ($eleve) {
                    $eleveQuery->where('id', $eleve->id);
                });
            });
        })->with('evaluation.module', 'eleve')->get();
        
        // Calculate average note
        $averageNote = $evaluationEleves->avg('note') ?? 0;

        // Calculate min and max notes
        $minNote = $evaluationEleves->count() > 0 ? $evaluationEleves->min('note') : 0;
        $maxNote = $evaluationEleves->count() > 0 ? $evaluationEleves->max('note') : 0;

        // Calculate total and passed students
        $totalStudents = $evaluationEleves->count();
        $passedStudents = $evaluationEleves->filter(function ($evaluationEleve) {
            return $evaluationEleve->note >= 10;
        })->count();

        // Calculate pass rate
        $passRate = $totalStudents > 0 ? ($passedStudents / $totalStudents * 100) : 0;

        return view('evaluations.notes', compact(
            'evaluationEleves', 
            'averageNote', 
            'minNote', 
            'maxNote', 
            'totalStudents', 
            'passedStudents', 
            'passRate'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Evaluation $evaluation)
    {
        $eleves = Eleve::all(); // Fetch all students
        return view('evaluationEleves.create', compact('evaluation', 'eleves'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'eleve_ids' => 'required|array',
            'eleve_ids.*' => 'exists:eleves,id',
            'notes' => 'required|array',
            'notes.*' => 'nullable|numeric|min:0|max:20', // Notes can be null
            'justificatifs.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Add file validation
        ]);
    
        $eleveIds = $request->input('eleve_ids');
        $notes = $request->input('notes');
        $justificatifs = $request->file('justificatifs');
    
        foreach ($eleveIds as $index => $eleveId) {
            if ($notes[$index] !== null) {
                // Check if the note is being created or updated
                $evaluationEleve = \App\Models\EvaluationEleve::updateOrCreate(
                    ['evaluation_id' => $evaluation->id, 'eleve_id' => $eleveId],
                    ['note' => $notes[$index]]
                );
    
                // Handle file upload
                if (isset($justificatifs[$index]) && $justificatifs[$index]->isValid()) {
                    $path = $justificatifs[$index]->store('justificatifs', 'public');
                    $evaluationEleve->update(['justificatif' => $path]);
                }
    
                // Send email only if it's a newly created note or the note has been updated
                if ($evaluationEleve->wasRecentlyCreated || $evaluationEleve->wasChanged('note')) {
                    $eleve = \App\Models\Eleve::find($eleveId);
                    $emailData = [
                        'note' => $notes[$index],
                        'evaluation' => $evaluation->name,
                        'date' => now()->toDateString(),
                    ];
    
                    \Illuminate\Support\Facades\Mail::to($eleve->email)
                        ->send(new \App\Mail\NouvelleNoteMailable($emailData));
                }
            }
        }
    
        return redirect()->route('evaluations.notes', $evaluation->id)
            ->with('success', 'Notes enregistrées avec succès.');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        // Les élèves peuvent voir leurs propres notes, mais pas gérer les évaluations
        $eleve = auth()->user()->eleve;
        
        // Vérifier si l'élève appartient au module de l'évaluation
        $evaluationEleve = EvaluationEleve::where('eleve_id', $eleve->id)
                         ->where('evaluation_id', $evaluation->id)
                         ->first();

        if (!$evaluationEleve) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette note.');
        }

        return view('evaluationEleves.show', compact('evaluationEleve', 'evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluationEleve $evaluationEleve)
    {
        $evaluation = $evaluationEleve->evaluation;
        $eleve = $evaluationEleve->eleve;
        return view('evaluationEleves.edit', compact('evaluationEleve', 'evaluation', 'eleve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluationEleve $evaluationEleve)
    {
        $validated = $request->validate([
            'note' => 'required|numeric|min:0|max:20'
        ]);

        $evaluationEleve->update($validated);

        return redirect()->route('evaluations.notes', $evaluationEleve->evaluation_id)
            ->with('success', 'Note mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluationEleve $evaluationEleve)
    {
        $evaluationId = $evaluationEleve->evaluation_id;
        $evaluationEleve->delete();

        return redirect()->route('evaluations.notes', $evaluationId)
            ->with('success', 'Note supprimée avec succès.');
    }
}
