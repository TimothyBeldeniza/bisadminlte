<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
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
        ->where('users.id', $userId)
        ->orderBy('complaints_transactions.id','DESC')
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'complaints_transactions.respondents','complaints_transactions.compDetails', 
                'transactions.status', 'transactions.userId')
        ->get();

        $fcomplaints = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->join('outside_complainants', 'complaints_transactions.id', '=', 'outside_complainants.compId')
        ->where('users.id', $userId)
        ->where('complaints_transactions.compType', 0)
        ->orderBy('complaints_transactions.id','DESC')
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'complaints_transactions.respondents','complaints_transactions.compDetails', 
                'outside_complainants.complainant',
                'transactions.status', 'transactions.userId')
        ->get();


        $blotters = DB::table('blotters_transactions')
        ->join('transactions', 'blotters_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('users.id', $userId)
        ->orderBy('blotters_transactions.id','DESC')
        ->select('blotters_transactions.id', DB::raw('date(blotters_transactions.created_at) as "date"'), 
                'blotters_transactions.respondents','blotters_transactions.blotDetails', 
                'transactions.status')
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

        
        return view('home', compact('documents', 'complaints', 'fcomplaints', 'blotters', 'xdocus'));
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
