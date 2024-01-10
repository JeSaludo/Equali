<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public $fillable = [
        'measure_a_score',
        'measure_b_score',
        'measure_c_score',
        'scaled_exam_score',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

