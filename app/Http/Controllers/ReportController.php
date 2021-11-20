<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('map2');
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
        $validator = Validator::make($request->all(), [
            'fullname'=>'required|max:255',
            'phoneno'=>'required',
            //'email'=>'',
            'report_title'=>'required|max:255',
            'report_desc'=>'required|max:255',
            'report_media'=>'image|mimes:jpeg,png,jpg|max:2048',
            'crime_category'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()
            ]);
        }
        else
        {
            $users = new Users;

            $users->fullname = $request->input('fullname') ;
            $users->email = $request->input('email');
            $users->contact_no = $request->input('phoneno');
            $users->save();

            $report = new Report;
            $report->report_title = $request->input('report_title');
            $report->report_desc = $request->input('report_desc');
            $report->crime_category = $request->input('crime_category');
            $report->latitude = $request->input('latitude');
            $report->longitude = $request->input('longitude');
            $report->user_id = $users->id; // get last inserted id
            if($request->hasFile('report_media'))
            {
                $file = $request->file('report_media');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/report/', $filename);
                $report->report_media = $filename;
            }

            $report->save();

            return response()->json([
                'status'=>200,
                'message'=>'Report sent successfully',
            ]);
        }
        // $report = new Report;
    }

    public function showallreport()
    {
        //$report = Report::all();
        //$users  = Users::all();
        $report = DB::table('report')->select('*')->join('users', 'report.user_id', '=', 'users.id')->get();
        //$report = DB::select('select * from report, users where report.id = users.id');
        //$report = DB::table('users')->join('report','users.id', '=', 'report.id')->get();

        return response()->json([
            'report' => $report,
            //'users' => $users,
        ]);
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
}
