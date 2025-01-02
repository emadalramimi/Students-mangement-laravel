<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->estEnseignant()) {
            // Logique pour le tableau de bord des enseignants
            return view('dashboard.enseignant', [
                'user' => $user
            ]);
        } else {
            // Logique pour le tableau de bord des élèves
            return view('dashboard.eleve', [
                'user' => $user
            ]);
        }
    }
}
