<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    
    protected $fillable = ['title','description', 'num_of_question', 'passing_score']; 



    public function examQuestion(){
         return $this->hasMany(ExamQuestion::class);
    }
}


