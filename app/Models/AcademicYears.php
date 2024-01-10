<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYears extends Model
{
    use HasFactory;
    protected $fillable = ['year_name', 'start_date', 'end_date'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }


}
