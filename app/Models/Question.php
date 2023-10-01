<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = ['question_text','category']; 



    public function choices(){
        return $this->hasMany(Choice::class);
    }

    public function correctAnswer()
    {
        return $this->choices()->where('is_correct', true)->value('choice_text');
    }

    public function examSubmission()
    {
        return $this->hasMany(Question::class, 'question_id');
    }

}
