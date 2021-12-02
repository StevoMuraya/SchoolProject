<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegEmail;
use App\Models\classes_held;
use App\Models\students;
use App\Models\unit_students;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students   =   students::latest()->get();
        return view('students.index', [
            'active' => 'students',
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|email|unique:students,student_email,except,student_id',
            'phone' => 'required|max:255|unique:students,student_phone,except,student_id',
            'stud_code' => 'required|max:255|unique:students,student_regNo,except,student_id',
        ]);

        $new_pass = Str::random(8);

        $students = students::create([
            'student_firstname' => $request->firstname,
            'student_lastname' => $request->lastname,
            'student_email' => $request->email,
            'student_phone' => $request->phone,
            'student_regNo' => $request->stud_code,
            'student_password' => Hash::make($new_pass),
            'student_profile' => 'default.jpg',
        ]);

        // $students = students::where('student_email', '=',)->get();


        Mail::to($request->email)->send(new StudentRegEmail($students, $new_pass));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student  = students::find($id);

        $unit_stud  = unit_students::find('4');

        $class_held  = classes_held::find('6');


        // dd($class_held->class_held_attendance_relation);

        // dd($unit_stud->unit_students_class_relation->classes_relation);


        // dd($student->students_unit_students_relation);

        return  view('students.student-show', [
            'active' => 'students',
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
