<?php

namespace App\Http\Controllers;


use App\Models\Students;
use App\Models\Courses;
use App\Models\Teachers;
use App\Models\Registrations;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;;


class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {   Log::info("Index function called");
        $students = Students::with('teacher')->paginate(10); // ดึงข้อมูลวิชาพร้อมข้อมูลอาจารย์ที่สอนวิชานั้น

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
        $teachers = DB::table('teachers')->get();

        return inertia('Student/Create', ['teachers' => $teachers,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // show all input data
        log::info($request->all());
        
        // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'major' => 'required|string|max:100',
            'phone' => 'required|string|size:10',
            'email' => 'required|string|max:255|unique:students,email',
            'teacher_id'=> 'required',
        ]);
    
        if ($validator->fails()) {
            //log::info('Validation Error:', $validator->errors()->toArray());
            return redirect()->route('student.create')
                ->withInput()
                ->withErrors($validator) // ใช้สำหรับ Validation Errors
                ->with('error', 'Failed to create student information. Please try again.');
        }
    
        // ดึงเฉพาะข้อมูลที่ผ่านการตรวจสอบแล้ว
        $validated = $request->only([
            'first_name',
            'last_name',
            'birth_date',
            'major',
            'phone',
            'email',
            'teacher_id',
        ]);
    
        try {
            DB::transaction(function () use ($validated, $request) {
                // 2. หาค่า student_id ล่าสุด
                $latestEmpNo = DB::table('students')->max('student_id') ?? 0; // ถ้าไม่มีข้อมูล ให้เริ่มที่ 0
                $newEmpno = $latestEmpNo + 1; // ค่าล่าสุด +1
    
                // 3. เพิ่มข้อมูลลงในตาราง students
                $studentData = [
                    'student_id' => $newEmpno,
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'major' => $validated['major'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'],
                    'teacher_id' => $validated['teacher_id' ],
                ];

                DB::table('students')->insert($studentData); 
    
            });

            session()->flash('success', 'Student information created successfully.');
            return redirect()->route('student.index');
                            
        } catch (\Exception $e) {
            Log::error($e->getMessage()); 
            // ใช้สำหรับการจับข้อผิดพลาดที่อาจเกิดขึ้นในขั้นตอนการบันทึกข้อมูลในฐานข้อมูล 
            return redirect()->route('student.create')
                                ->with('error', 'An error occurred while processing the database.');
                
        }
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
    public function edit(Students $student)
    {
        Log::info("Edit function called with student_id: " . $student->student_id);

        $teachers = Teachers::all();
        return Inertia::render('Student/Edit', [
            'students' => $student->load('teacher'),
            'teachers' => $teachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $student_id)
    {
           // show all input data
           log::info($request->all());
        
           // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม 
           $validator = Validator::make($request->all(), [ 
               'first_name' => 'required|string|max:20',
               'last_name' => 'required|string|max:20',
               'major' => 'required|string|max:100',
               'phone' => 'required|string|size:10',
               'email' => 'required|string|max:255|unique:students,email,' . $student_id . ',student_id',
               'teacher_id'=> 'required',
           ]);
       
           if ($validator->fails()) {
               //log::info('Validation Error:', $validator->errors()->toArray());
              
               return redirect()->route('student.edit', ['student' => $student_id])
                   ->withInput()
                   ->withErrors($validator) // ใช้สำหรับ Validation Errors
                   ->with('error', 'Failed to create student information. Please try again.');
           }
       
           // ดึงเฉพาะข้อมูลที่ผ่านการตรวจสอบแล้ว
           $validated = $request->only([
               'first_name',
               'last_name',
               'birth_date',
               'major',
               'phone',
               'email',
               'teacher_id',
           ]);
       
           try {
               DB::transaction(function () use ($student_id, $validated) {
                    // ดึงข้อมูลนักเรียนจากฐานข้อมูล
                    $student = Students::findOrFail($student_id); //ถ้าไม่มีนักเรียนที่มี student_id นี้ ระบบจะ แจ้ง error ทันที

                        // ตรวจสอบว่า student_id ไม่ถูกอัปเดต
                        //Log::info("Before update: " . print_r($student->toArray(), true));

                        // อัปเดตข้อมูลนักเรียนจากค่าvalidated  (ไม่รวม student_id)
                    $student->update($validated); 
                        //Log::info("After update: " . print_r($student->toArray(), true)); // เช็คข้อมูลหลังอัปเดต
                });
       
               // ถ้าการทำงานทุกอย่างสำเร็จ ให้ไปที่หน้า student.index โดยกำหนดค่าข้อความ success
               return redirect()->route('student.index')
                               ->with('success', 'Student information update successfully.');

       
           } catch (\Exception $e) {
               Log::error($e->getMessage()); 
               //  ใช้สำหรับการจับข้อผิดพลาดที่อาจเกิดขึ้นในขั้นตอนการบันทึกข้อมูลในฐานข้อมูล 
                return redirect()->route('student.edit', ['student' => $student_id])
                    ->with('error', 'An error occurred while processing the database.');
                   
           }
       }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $student)
    {   Log::info("Destroy function called");
        try{  //ลบข้อมูลนักเรียนที่ตรงกับ ID ที่ได้รับ
            $student->delete();
           
            return redirect()->route('student.index')
                                ->with('success', "Student information deleted successfully.");

            }catch(\Exception $e){
            Log::error($e->getMessage()); 
            
            return redirect()->route('student.index')
                                ->with('error', 'Student deleted information deleted failed.');
            }      
    }
}
