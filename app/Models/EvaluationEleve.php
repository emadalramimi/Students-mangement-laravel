<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationEleve extends Model
{
    use HasFactory;
    protected $fillable = ['evaluation_id', 'eleve_id', 'note', 'justificatif'];
 
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
    
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    
}
