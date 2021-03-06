<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lecturers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\LecturerRegEmail;
use App\Models\classes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LecturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->Middleware('auth', ['except' => ['lec_password_qr', 'display_qr_code']]);
        // $this->Middleware('verified');
    }


    public function index()
    {
        $lecturers  =  Lecturers::latest()->get();
        return view('lecturers.index', [
            'active' => 'lecturers',
            'lecturers' => $lecturers
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
            'email' => 'required|max:255|email|unique:lecturers,lec_email,except,lec_id',
            'phone' => 'required|max:255|regex:/(254)[0-9]{9}/|unique:lecturers,lec_phone,except,lec_id',
            'lec_code' => 'required|max:255|unique:lecturers,lec_code,except,lec_id',
            'department' => 'required|max:255',
        ]);

        $new_pass = Str::random(8);
        // $new_pass = "qwertyman";

        $lecturer = Lecturers::create([
            'lec_firstname' => $request->firstname,
            'lec_lastname' => $request->lastname,
            'lec_email' => $request->email,
            'lec_phone' => $request->phone,
            'lec_code' => $request->lec_code,
            'department' => $request->department,
            'lec_image' => 'default.jpg',
            'date_reg' => Carbon::now(),
            'lec_password' => Hash::make($new_pass),
            'reg_by' => auth()->user()->id
        ]);

        // dd($lecturer);

        // $lecturer = Lecturers::where('lec_email', '=', $request->email)->first();

        Mail::to($lecturer->lec_email)->send(new LecturerRegEmail($lecturer, $new_pass));
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

    public function lec_password_qr($class_id, $lec_id)
    {
        $lecturer = Lecturers::find($lec_id);
        $class = classes::find($class_id);

        // dd($class, $lecturer);

        return  view('lecturers.lec-pass', [
            'active' => 'lec',
            'class' => $class,
            'lecturer' => $lecturer,
        ]);
    }

    public function display_qr_code(Request $request, $class_id, $lec_id)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        $lecturer = Lecturers::latest()
            ->where('lec_id', '=', $lec_id)->first();


        if (!(password_verify($request->password, $lecturer->lec_password))) {
            return back()->with('status', 'Invalid password');
        }

        $class = classes::find($class_id);

        return  view('lecturers.display-code', [
            'active' => 'lec',
            'class' => $class,
        ]);
    }
}
