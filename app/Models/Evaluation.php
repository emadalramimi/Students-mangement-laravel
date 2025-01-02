<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'module_id', 'date', 'coefficient'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function evaluationEleves()
    {
        return $this->hasMany(EvaluationEleve::class);
    }
    
}
