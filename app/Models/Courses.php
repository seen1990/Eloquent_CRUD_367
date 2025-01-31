<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = ['course_name', 'course_description', 'teacher_id'];

    public function students()
    {
        return $this->belongsToMany(Students::class, 'registrations');//1 วิชา มี นศ. เรียนหลายคน
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'teacher_id');//วิชานั้นต่ออาจารย์คนนั้น
    }
}
