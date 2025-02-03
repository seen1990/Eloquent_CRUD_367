<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['student_id', 'course_id'];
    protected $primaryKey = 'registration_id';

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id', 'student_id');//1 นศ. ลงทะเบียนหลายวิชา
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');//1 วิชา มีนศ.ลงทะเบียนหลายคน
    }
}
