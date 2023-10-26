<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifiedStudent extends Model
{
    use HasFactory;

    protected $fillable = ['interview','interview_date']; 


    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function getTimeAttribute($value)
    {
        // Convert the 24-hour format time to 12-hour format for display
        return date('h:i A', strtotime($value));
    }

}
