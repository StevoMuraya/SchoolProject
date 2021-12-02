<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units  =   Units::latest()->get();
        return view('units.index', [
            'active' => 'units',
            'units' => $units,
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
            'unit_code' => 'required|max:255|unique:units,unit_code,except,unit_id',
            'unit_name' => 'required|max:255',
            'unit_department' => 'required|max:255',
        ]);

        Units::create([
            'unit_code' => $request->unit_code,
            'unit_name' => $request->unit_name,
            'unit_department' => $request->unit_department,
            'reg_by' => auth()->user()->id
        ]);

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
        $this->validate($request, [
            'unit_code_edit' => 'required|max:255',
            'unit_name_edit' => 'required|max:255',
            'unit_department_edit' => 'required|max:255',
        ]);

        // dd($id);
        // $unitsModel = Units::where('unit_id', $id)->first();

        Units::where('unit_id', $id)->first()
            ->update([
                'unit_code' => $request->unit_code_edit,
                'unit_name' => $request->unit_name_edit,
                'unit_department' => $request->unit_department_edit,
            ]);

        // dd($request->unit_department_edit);
        // $unitsModel->unit_code = $request->unit_code_edit;
        // $unitsModel->unit_name = $request->unit_name_edit;
        // $unitsModel->unit_department = $request->unit_department_edit;
        // $unitsModel->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Units::where('unit_id', $id)->first();
        $unit->delete();
        return back();
    }
}
