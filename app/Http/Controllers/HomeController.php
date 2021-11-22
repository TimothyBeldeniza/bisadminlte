<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   function __construct()
   {
      $this->middleware(['auth','verified']);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Transactions $transaction)
    {
        
        $userId = Auth::user()->id;
    
        $documents = DB::table('documents_transactions')
        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
        ->join('users', 'transactions.userId', '=', 'users.id')
        ->where('users.id', $userId)
        ->where('transactions.status', '<>', 'Cancelled')

        ->orderBy('documents_transactions.id','DESC')
        ->select('documents_transactions.id',  'documents_transactions.transId', DB::raw('date(documents_transactions.created_at) as "date"'), 
                'documents_transactions.purpose', 'documents_transactions.transId', 'document_types.docType', 
                'documents_transactions.reason', 'transactions.status', 'transactions.userId')
        ->get();


        $complaints = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('transactions.userId', $userId)
        ->where('complaints_transactions.compType', '1')
        ->orderBy('complaints_transactions.id','DESC')
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'complaints_transactions.respondents', 
                'transactions.status', 'transactions.userId')
        ->get();

        $residents = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id') 
        ->join('users', 'transactions.userId', '=', 'users.id') 
        ->join('inside_respondents', 'inside_respondents.compId', '=', 'complaints_transactions.id')
        ->where('inside_respondents.userId', $userId)
        ->where('complaints_transactions.compType', '1')
        ->orderBy('complaints_transactions.id','DESC')
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'users.lastName', 'users.firstName',
                'transactions.status', 'transactions.userId')
        ->get();

        $nonresidents = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id') 
        ->join('outside_complainants', 'outside_complainants.compId', '=', 'complaints_transactions.id') 
        ->join('inside_respondents', 'inside_respondents.compId', '=', 'complaints_transactions.id')
        ->where('inside_respondents.userId', $userId)
        ->where('complaints_transactions.compType', '0')
        ->orderBy('complaints_transactions.id','DESC')
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'outside_complainants.complainant',
                'transactions.status', 'transactions.userId')
        ->get();

        
        $xdocus = DB::table('documents_transactions')
        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('users.id', $userId)
        ->where('transactions.status', 'Cancelled')
        ->orderBy('documents_transactions.id','DESC')
        ->select('documents_transactions.id', 
                DB::raw('date(documents_transactions.created_at) as "date"'), 
                DB::raw('date(documents_transactions.updated_at) as "cancelDate"'), 
                'documents_transactions.purpose', 'documents_transactions.transId', 'documents_transactions.reason',
                'document_types.docType','transactions.status')
        ->get();

        $stats = [
            'settled' => Transactions::where('status', '=' ,'Settled')->count(),
            'escalated' => Transactions::where('status', '=' ,'Escalated')->count(),
            'unresolved' => Transactions::where('status', '=' ,'Unresolved')->count(),
            'onGoing' => Transactions::where('status', '=' ,'On Going')->count(),
            'dismissed' => Transactions::where('status', '=' ,'Dismissed')->count(),
            'due' => Transactions::where('status', '=' ,'For Validation')->count(),
            'readyToClaim' => Transactions::where('status', '=' ,'Ready To Claim')->count(),
            'paid' => Transactions::where('status', '=' ,'Paid')->count(),
            'released' => Transactions::where('status', '=' ,'Released')->count(),
            'disapproved' => Transactions::where('status', '=' ,'Disapproved')->count(),
            'cancelled' => Transactions::where('status', '=' ,'Cancelled')->count(),
            'male' => User::whereHas("roles", function($q){ $q->where("name", "!=", "Admin"); })->where('sex','Male')->count(),
            'female' => User::whereHas("roles", function($q){ $q->where("name","!=", "Admin"); })->where('sex','Female')->count(),
            'senior' => User::whereHas("roles", function($q){ $q->where("name", "!=", "Admin"); })->where('dob', '<=', Carbon::now()->subDecades(6)->format('Y-m-d'))->count(),
            'totalRes' =>  User::whereHas("roles", function($q){ $q->where("name", "!=", "Admin"); })->count(),
        ];

        $count = [
            'dues' => $documents->where('status', 'For Validation')->count(),
            'comps' => $complaints->where('status', 'Unresolved')->count(),
            'res' => $residents->where('status', 'Unresolved')->count(),
            'nonr' => $nonresidents->where('status', 'Unresolved')->count(),
        ];


        return view('home', compact('documents', 'complaints', 'residents', 'nonresidents', 'xdocus', 'stats', 'count'));
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
