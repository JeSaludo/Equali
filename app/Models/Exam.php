<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['exam_name', 'exam_date', 'passing_score'];

  

    public function examSubmissions()
    {
        return $this->hasMany(ExamSubmission::class);
    }

   
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
