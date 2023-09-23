<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = ['question_text','category']; 


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

  
    public function studentResponses()
    {
        return $this->hasMany(StudentResponse::class);
    }

    public function choices()
{
    return $this->hasMany(Choice::class);
}
}
