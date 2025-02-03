<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email','major', 'teacher_id'];
    protected $primaryKey = 'student_id'; //กำหนดให้คอลัมน์นี่เป็น PK

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'registrations', 'student_id', 'course_id'); //นศ. 1 คน ลงทะเบียนได้หลายวิชา
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'teacher_id'); // นศ. 1 คน มีอาจารย์ที่ปรึกษา 1 คน
    }
}
