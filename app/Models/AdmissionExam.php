<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionExam extends Model
{
    use HasFactory;

    protected $fillable = [
       'score',
       'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
