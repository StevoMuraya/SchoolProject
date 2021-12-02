<?php

namespace App\Http\Controllers;

use App\Models\Lecturers;
use App\Models\unit_lecs;
use App\Models\Units;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitLecturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

            'unit_id' => 'required|max:255',
            'lec_code' => 'required|max:255',
        ]);

        $lecturers = Lecturers::latest()->where('lec_code', '=', $request->lec_code)->get()->first();

        $unit_dublicate  = unit_lecs::latest()->where('lec_id', '=', $lecturers->lec_id)->where('unit_id', '=', $request->unit_id)->get();

        if (count($unit_dublicate) > 0) {
            return back()->with('status', 'This lecturer is already registered under that unit');
        } else {

            unit_lecs::create([
                'lec_id' => $lecturers->lec_id,
                'unit_id' => $request->unit_id,
                'assigned_by' => auth()->user()->id,
            ]);
        }
        return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Units::find($id);
        $lecturers = Lecturers::latest()->get();
        $lecturers2 = Lecturers::find('2');
        $unit_lecs = unit_lecs::latest()->where('unit_id', '=', $id)->get();


        // $lec_units = Lecturers::latest()->where('lec_id', '=', $unit_lecs->lec_id)->get();

        // $unit_lecs = $unit->units_unit_relation;
        // $lec_units = $lecturers2->lecturer_unit_relation;
        // $lecs_unit = $unit_lecs->lecturer_unit_relation;


        // dd($lec_units);


        // dd($unit);
        return  view('units.unit-assign', [
            'active' => 'units',
            'unit' => $unit,
            'unit_lecs' => $unit_lecs,
            'lecturers' => $lecturers,
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
        $unit = unit_lecs::where('id', $id)->first();
        // dd($unit);
        $unit->delete();
        return back();
    }
}
