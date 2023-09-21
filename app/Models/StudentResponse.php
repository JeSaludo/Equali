<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

  
    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

 
    public function examSubmission()
    {
        return $this->belongsTo(ExamSubmission::class);
    }
}
