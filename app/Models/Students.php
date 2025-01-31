<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Students extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'gender', 'email', 'birth_date', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculties::class, 'faculty_id', 'faculty_id'); // นศ. 1 คน สังกัด 1 คณะ
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'registrations'); //นศ. 1 คน ลงทะเบียนได้หลายวิชา
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'teacher_id'); // นศ. 1 คน มีอาจารย์ที่ปรึกษา 1 คน
    }
}
