<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResponse extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'question_id',
        'choice_id',
    ];
    public function user()
     {
         return $this->belongsTo(User::class);
     }
}
