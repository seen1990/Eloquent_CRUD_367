<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Teachers;
use App\Models\Registrations;
use App\Models\Faculties;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $students = Students::with('courses','teacher')->paginate(10); // ดึงข้อมูลวิชาพร้อมข้อมูลอาจารย์ที่สอนวิชานั้น

        // ส่งข้อมูลไปยัง React ผ่าน Inertia
        return Inertia::render('Student/Index', [
            'students' => $students, // ส่งข้อมูลนักเรียน
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students)
    {
        //
    }
}
