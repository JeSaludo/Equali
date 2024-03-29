<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use PDO;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'contact_number',
        'password',
        'academic_year_id',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // protected function examSubmissions(){
    //     return $this->hasMany(ExamSubmission::class);
    // }
    public function academicYear()
    {
        return $this->belongsTo(AcademicYears::class);
    }
    public function admissionExam()
    {
        return $this->hasOne(AdmissionExam::class);
    }

    public function qualifiedStudent()
    {
        return $this->hasOne(QualifiedStudent::class);
    }

    public function studentInfo(){
        return $this->hasOne(StudentInfo::class);
    }

   
    public function result(){
        return $this->hasOne(Result::class);
    }

    public function examResponse(){
        return $this->hasMany(ExamResponse::class);
    }

    public function userTimeStamp()
    {
        return $this->hasOne(UserTimeStamp::class);
    }

    
}
