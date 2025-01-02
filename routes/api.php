<?php

use App\Models\Eleve;
use Illuminate\Http\Request;
use App\Models\EvaluationEleve;

use App\Http\Controllers\EleveController;

Route::middleware('auth:sanctum')->get('/eleves', [EleveController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {


    Route::get('/eleve/{id}/notes', function ($id) {
        $notes = EvaluationEleve::with('evaluation:id,name')
            ->where('eleve_id', $id)
            ->select('evaluation_id', 'note', 'created_at')
            ->get();

        if ($notes->isEmpty()) {
            return response()->json(['message' => 'No notes found for this student'], 404);
        }

        return response()->json($notes);
    });
});
