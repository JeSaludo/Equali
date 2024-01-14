<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeStamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualification_status',
        'qualification_date',
        
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
