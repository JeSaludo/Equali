<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubmission extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

   
    public function studentResponses()
    {
        return $this->hasMany(StudentResponse::class);
    }
}
