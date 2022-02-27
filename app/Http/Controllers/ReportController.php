<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            'fullname'      => 'required|max:255',
            'phoneno'       => 'required',
            'email'         => 'email:rfc,dns',
            'report_title'  => 'required|max:255',
            'report_desc'   => 'required|max:255',
            'report_media'  => 'image|mimes:jpeg,png,jpg|max:2048',
            'crime_category'=> 'required|in:Housebreak,Robbery,Theft,Motor vehicle theft,Assault',
            'crimedate'     => 'required',
            'latitude'      => 'required',
            'longitude'     => 'required',
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
            $lat  = $request->input('latitude');
            $long = $request->input('longitude');
            $extracteddata = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/".$long.",".$lat.".json?types=place&limit=1&access_token=pk.eyJ1IjoibmFpbWhhc2ltIiwiYSI6ImNrdmFxaGYzbTJsOGgydnA2OWVhZHoxOWIifQ.HpzTWE563N64yu0JYi251w");
            $assocArray = json_decode($extracteddata);
            $location = $assocArray->features[0]->text;
            $report->district = $location;
            $report->crime_date = $request->input('crimedate');
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

    public function showchart(){
        $crimecategorychart = DB::select(DB::raw("SELECT report.crime_category, count(report.report_title) as total FROM report GROUP BY report.crime_category;"));
        $districtchart = DB::select(DB::raw("SELECT count(report.report_title) AS total, report.district FROM report GROUP BY report.district;"));
        $totalperdate = DB::select(DB::raw("SELECT count(report_title) as 'jumlah', crime_date as 'date' FROM `report` group BY crime_date ASC;"));

        return response()->json([
            'categorychart' => $crimecategorychart,
            'districtchart' => $districtchart,
            'totalperdate'  => $totalperdate,
        ]);
    }

    public function showallreport()
    {
        //$report = Report::all();
        //$users  = Users::all();
        // $report = DB::table('report')->select('*')->join('users', 'report.user_id', '=', 'users.id')->get();
        $report = DB::table('users')->select('*')->join('report', 'report.user_id', '=', 'users.id')->get();
        //$report = DB::select('select * from report, users where report.id = users.id');
        //$report = DB::table('users')->join('report','users.id', '=', 'report.id')->get();

        return response()->json([
            'report' => $report,
            //'users' => $users,
        ]);
    }

    public function getAllPost(){
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/102.29742609007513,6.05473460220567.json?types=place&limit=1&access_token=pk.eyJ1IjoibmFpbWhhc2ltIiwiYSI6ImNrdmFxaGYzbTJsOGgydnA2OWVhZHoxOWIifQ.HpzTWE563N64yu0JYi251w");
        return $response->json();
    }

    public function getSinglePost($lat,$long){
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/".$long.",".$lat.".json?types=place&limit=1&access_token=pk.eyJ1IjoibmFpbWhhc2ltIiwiYSI6ImNrdmFxaGYzbTJsOGgydnA2OWVhZHoxOWIifQ.HpzTWE563N64yu0JYi251w");
        $assocArray = json_decode($response);
        $temp = $assocArray->features[0]->text;
        return $temp;
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
        // $report = Report::find($id);
        $report = DB::table('users')
                    ->select('*')
                    ->join('report', "users.id", "=", 'report.user_id')
                    ->where("report.id", "=", $id)
                    ->delete();
        //$report->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}
