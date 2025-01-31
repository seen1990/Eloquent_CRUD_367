<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculties extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_name'];

    public function students()
    {
        return $this->hasMany(Students::class); //1 คณะ มี นักศึกษาหลายคน
    }

    public function teachers()
    {
    return $this->hasMany(Teachers::class);//1 คณะ มี อาจารย์หลายคน
    }
}
