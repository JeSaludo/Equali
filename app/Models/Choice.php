<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    protected $fillable = ['choice_text', 'is_correct']; 


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function studentResponse()
    {
        return $this->hasOne(StudentResponse::class);
    }
}
