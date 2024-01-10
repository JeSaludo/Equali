<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionExam extends Model
{
    use HasFactory;

    protected $fillable = [
       'raw_score',
       'percentage',
       'status',
       'total_score',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
