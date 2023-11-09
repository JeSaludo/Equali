<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;

  
    protected $fillable = [
       
        'address',
        'course',
        'school_last_attended',
        'year_graduated',
        'gpa',
        'academic_track',
        'average_score',
      
         
         'remarks'

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
