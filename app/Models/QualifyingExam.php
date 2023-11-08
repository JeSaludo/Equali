<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifyingExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'status',
        'total_score',
       
     ];
 
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
