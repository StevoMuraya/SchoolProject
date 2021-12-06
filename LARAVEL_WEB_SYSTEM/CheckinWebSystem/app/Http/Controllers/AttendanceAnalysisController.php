<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\unit_students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceAnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_years = classes::select('class_year')->distinct()->get();

        // foreach ($class_years as $class_year) {
        //     echo   $class_year->class_year;

        //     $class_sem = DB::table('classes')
        //         ->select(DB::raw('class_sem'))
        //         ->where('class_year', '=', $class_year->class_year)
        //         ->get();

        //     // dd($class_sem);
        // }

        // dd($class_years);
        return view('attendance-analysis.index', [
            'active' => 'summaries',
            'class_years' => $class_years,
            // 'class_sem' => $class_years,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function ClassYearSemAnalysis($class_year, $class_sem)
    {

        $classes = classes::where('class_year', '=', $class_year)
            ->where('class_sem', '=', $class_sem)->get();

        // foreach ($class_sems as $class_sem) {
        //     echo   $class_sem->classes_lecturer_relation;

        //     // $class_sem = DB::table('classes')
        //     //     ->select(DB::raw('class_sem'))
        //     //     ->where('class_year', '=', $class_year->class_year)
        //     //     ->get();

        //     // dd($class_sem);
        // }
        // dd($classes);
        return view('attendance-analysis.attendance-units', [
            'active' => 'summaries',
            'class_year' => $class_year,
            'class_sem' => $class_sem,
            'classes' => $classes,
        ]);
    }

    public function StduentsClassAnalysis($class_year, $class_sem, $class_id)
    {
        $students_list = unit_students::where('class_id', '=', $class_id)->get();
        $class_details = classes::find($class_id);
        return view('attendance-analysis.attendance-students', [
            'active' => 'summaries',
            'class_year' => $class_year,
            'class_sem' => $class_sem,
            'class_id' => $class_id,
            'students_list' => $students_list,
            'class_details' => $class_details,
        ]);
    }
}
