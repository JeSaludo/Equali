<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = ['question_text','category', 'image_path','year','eligible_for_exam']; 



    public function choices(){
        return $this->hasMany(Choice::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

   
    public function examResponse()
    {
        return $this->hasMany(ExamResponse::class);
    }


    public function correctAnswer()
    {
        return $this->choices()->where('is_correct', true)->value('choice_text');
    }   

    

    
    public function examSubmission()
    {
        return $this->hasMany(Question::class, 'question_id');
    }

   

    public function getResponseCounts()
    {
        $responseCounts = [];

        foreach ($this->choices->where('choice_text', '!=', 'No Answer') as $choice) {
            $responseCounts[] = $this->examResponse->where('choice_id', $choice->id)->count();
        }
        
        return $responseCounts;
    }

    public function getChoiceLabels()
    {       
        return $this->choices->where('choice_text', '!=', 'No Answer')->pluck('choice_text')->toArray();
    }

    

   
    


}
