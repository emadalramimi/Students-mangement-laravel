<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Module;
use App\Models\Evaluation;
use App\Models\EvaluationEleve;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalEleves = Eleve::count();
        $totalModules = Module::count();
        $totalEvaluations = Evaluation::count();

        // Calculate general average
        $moyenneGenerale = EvaluationEleve::avg('note') ?? 0;

        // Get upcoming evaluations
        $prochaines_evaluations = Evaluation::with('module')
            ->where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        // Get module statistics
        $stats_modules = DB::table('evaluation_eleves')
            ->join('evaluations', 'evaluation_eleves.evaluation_id', '=', 'evaluations.id')
            ->join('modules', 'evaluations.module_id', '=', 'modules.id')
            ->select(
                'modules.nom as module_nom',
                DB::raw('AVG(evaluation_eleves.note) as moyenne')
            )
            ->groupBy('modules.id', 'modules.nom')
            ->get();

        return view('home', compact(
            'totalEleves',
            'totalModules',
            'totalEvaluations',
            'moyenneGenerale',
            'prochaines_evaluations',
            'stats_modules'
        ));
    }
}
