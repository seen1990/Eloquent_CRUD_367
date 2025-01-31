<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teachers extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'gender','email'];

    public function courses()
    {
        return $this->hasMany(Courses::class, 'teacher_id', 'teacher_id'); // 1 อาจารย์ สอนหลายวิชา
    }

    public function faculty()
    {
    return $this->belongsTo(Faculties::class, 'faculty_id', 'faculty_id');//1 อาจารย์สังกัด 1 คณะ
    }

    public function students()
    {
    return $this->belongsTo(Students::class, 'student_id', 'student_id');//1 อาจารย์เป็นที่ปรึกษาของนศ.หลายคน
    }

}
