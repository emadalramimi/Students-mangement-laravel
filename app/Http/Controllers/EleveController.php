<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Rules\ValidImageFile;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eleves = Eleve::paginate(10);
        return view('eleves.index', compact('eleves'));
    }

    public function api(Request $request)
    {
        $limit = $request->input('limit', 10);
        $eleves = Eleve::limit($limit)->get();

        return response()->json($eleves);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eleves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date|before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
            'numero_etudiant' => 'required|unique:eleves,numero_etudiant|size:8',
            'email' => 'required|email|unique:eleves,email',
            'image' => [
                'nullable',
                'file',
                'max:2048',
                new ValidImageFile()
            ]
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $validated['image'] = $imagePath;
        }

        Eleve::create($validated);
        return redirect()->route('eleves.index')->with('success', 'Élève ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('eleves.show', compact('eleve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('eleves.edit', compact('eleve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'date_naissance' => 'required|date',
                'numero_etudiant' => [
                    'required', 
                    'string', 
                    'size:8', 
                    Rule::unique('eleves', 'numero_etudiant')->ignore($eleve->id)
                ],
                'email' => [
                    'required', 
                    'email', 
                    Rule::unique('eleves', 'email')->ignore($eleve->id)
                ],
                'image' => [
                    'nullable',
                    'file',
                    'max:2048',
                    new ValidImageFile()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($eleve->image && Storage::exists('public/' . $eleve->image)) {
                Storage::delete('public/' . $eleve->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $eleve->update($validated);
        return redirect()->route('eleves.index')->with('success', 'Élève mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $eleve = Eleve::findOrFail($id);

        // Delete the associated image if it exists
        if ($eleve->image && Storage::exists('public/' . $eleve->image)) {
            Storage::delete('public/' . $eleve->image);
        }

        $eleve->delete();
        return redirect()->route('eleves.index')->with('success', 'Élève supprimé avec succès.');
    }

    public function notes($id)
    {
        $eleve = Eleve::with('evaluationEleves.evaluation')->findOrFail($id);
        $average = $eleve->evaluationEleves->avg('note');
        return view('eleves.notes', compact('eleve', 'average'));
    }
    public function exportNotes($id)
    {
        $eleve = Eleve::with('notes')->find($id);

        if (!$eleve) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json($eleve->notes);
    }
}
