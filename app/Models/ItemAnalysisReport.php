<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAnalysisReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'di',
        'year',
        // Add any other fields you have in your ItemAnalysisReport model
    ];
}
