<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('permission:module-reports',['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['pieChart'] = DB::table('documents_transactions')
        ->groupBy('day_name')
        ->orderBy('count')
        ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as 'day_name'"))
        ->get();

        $data2['pieChart2'] = DB::table('complaints_transactions')
        ->groupBy('day_name')
        ->orderBy('count')
        ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as 'day_name'"))
        ->get();

        $data3['pieChart3'] = DB::table('blotters_transactions')
        ->groupBy('day_name')
        ->orderBy('count')
        ->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as 'day_name'"))
        ->get();
    

        return view('reports.index')
        ->with($data)
        ->with($data2)
        ->with($data3);
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
}
