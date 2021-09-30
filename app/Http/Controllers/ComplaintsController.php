<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;
// use App\Models\AvailedServices;
use App\Models\ComplaintsTransactions;
use App\Models\OutsideComplainants;
use App\Models\Hearings;
use App\Models\ServiceMaintenances;
use App\Models\Services;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade;
use PDF;

class ComplaintsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('permission:res-module-file-complaint', ['only' => ['create','store']]);
        $this->middleware('permission:module-filed-complaints', ['only' => 'index']);
        $this->middleware('permission:complaint-view-complaint-form', ['only' => 'pdfViewComplaint']);
        $this->middleware('permission:complaint-save-complaint-form', ['only' => 'pdfSaveComplaint']);
        
        // $this->middleware('permission:complaint-show-details', ['only' => 'index']);
        $this->middleware('permission:complaint-settle', ['only' => 'settle']);
        $this->middleware('permission:complaint-view-settle-form', ['only' => 'pdfViewSettle']);
        $this->middleware('permission:complaint-save-settle-form', ['only' => 'pdfSaveSettle']);

        $this->middleware('permission:complaint-escalate', ['only' => 'escalate']);
        $this->middleware('permission:complaint-view-escalation-form', ['only' => 'pdfViewEscalate']);
        $this->middleware('permission:complaint-save-escalation-form', ['only' => 'pdfSaveEscalate']);
        $this->middleware('permission:complaint-reject', ['only' => 'reject']);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('term')){
            $data = DB::table('complaints_transactions')
            ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->orderBy('complaints_transactions.id','DESC')
            ->where('complaints_transactions.compType', 1)
            ->where('users.lastName', 'Like', '%' . request('term') . '%')
            ->orWhere('users.firstName', 'Like', '%' . request('term') . '%')
            ->orWhere('complaints_transactions.respondents', 'Like', '%' . request('term') . '%')
            ->orWhere('transactions.status', 'Like', '%' . request('term') . '%')
            ->orWhere('complaints_transactions.respondents', 'Like', '%' . request('term') . '%')
            ->select('complaints_transactions.id', 'complaints_transactions.transId', 
                    'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                    DB::raw('date(complaints_transactions.created_at) as "date"'),
                    'users.firstName','users.lastName', 'users.houseNo', 'users.street', 
                    'transactions.status','transactions.userId')
            ->paginate(6);
            $data->appends($request->all());

        }else if(!$request->input('term')){
            $data = DB::table('complaints_transactions')
            ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->orderBy('complaints_transactions.id','DESC')
            ->where('complaints_transactions.compType', 1)
            ->select('complaints_transactions.id', 'complaints_transactions.transId', 
                    'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                    DB::raw('date(complaints_transactions.created_at) as "date"'),
                    'users.firstName','users.lastName', 'users.houseNo', 'users.street',
                    'transactions.status','transactions.userId')
            ->paginate(6);
        }
        return view('complaints.index', compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 6);
    }

    public function outsider(Request $request)
    {
        if($request->input('term')){
            $data = DB::table('complaints_transactions')
            ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->join('outside_complainants', 'complaints_transactions.id', '=', 'outside_complainants.compId')
            ->orderBy('complaints_transactions.id','DESC')
            ->where('complaints_transactions.compType', 0)
            ->where('outside_complainants.complainant', 'Like', '%' . request('term') . '%')
            ->orWhere('complaints_transactions.respondents', 'Like', '%' . request('term') . '%')
            ->orWhere('transactions.status', 'Like', '%' . request('term') . '%')
            ->select('complaints_transactions.id', 'complaints_transactions.transId', 
                    'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                    DB::raw('date(complaints_transactions.created_at) as "date"'),
                    'outside_complainants.complainant','outside_complainants.address',  
                    'transactions.status','transactions.userId')
            ->paginate(6);
            $data->appends($request->all());

        }else if(!$request->input('term')){
          $data = DB::table('complaints_transactions')
          ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
          ->join('users', 'transactions.userId', '=', 'users.id')
          ->join('outside_complainants', 'complaints_transactions.id', '=', 'outside_complainants.compId')
          ->orderBy('complaints_transactions.id','DESC')
          ->where('complaints_transactions.compType', 0)
          ->select('complaints_transactions.id', 'complaints_transactions.transId', 'complaints_transactions.compType', 
                  'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                  DB::raw('date(complaints_transactions.created_at) as "date"'),
                  'outside_complainants.complainant', 'outside_complainants.address',
                  'transactions.status','transactions.userId')
          ->paginate(6);
        }
        return view('complaints.outsider', compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 6);
    }

    public function getDocData($transId, $userId)
    {
        $td = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('users.id', $userId)
        ->where('complaints_transactions.id', $transId)
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'complaints_transactions.respondents', 'complaints_transactions.respondentsAdd','complaints_transactions.reason',
                'complaints_transactions.compDetails','users.lastName', 'users.firstName', 'users.houseNo', 'users.street','transactions.unique_code')
        ->first();
        // dd($transId,$userId);
        $brgy = DB::table('barangay')
        ->select('id', 'name', 'zipCode', 'city', 'province', 'region', 
                'logoPath', 'cityLogoPath')
        ->first();
        
        $officials = DB::table('barangay_officials')
        ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 'position')
        ->get();

        return compact('td', 'officials', 'brgy');
    }

    public function pdfViewComplaint($transId, $userId) 
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        // dd($document);
        return view('complaints.form')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfSaveComplaint($transId, $userId) 
    {
        $document = $this->getDocData($transId, $userId); 
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        // $pdf = PDF::loadView('complaints.form', compact('data', 'td', 'officials'));
        $pdf = PDF::loadView('complaints.form', ['td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.'-'.'Complaint-Form.pdf');
    }

    public function pdfViewEscalate($transId, $userId)
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.escalate')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
        // return view('complaints.escalate', compact('data', 'td', 'officials'));
    }

    public function pdfSaveEscalate($transId, $userId)
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $pdf = PDF::loadView('complaints.escalate', ['td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.$td->firstName.'-'.'Escalation-Form.pdf');
    }

    public function pdfViewSettle($transId, $userId)
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.settle')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfSaveSettle($transId, $userId)
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $pdf = PDF::loadView('complaints.settle', ['td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.'-'.'Settlement-Form.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->where('id', '>', 1);
        return view('complaints.create', ['users' => $users]);
    }

    public function autocomplete(Request $request)
    {
        $data = User::select('firstName')
                ->where("firstName","LIKE","%{$request->query}%")
                ->get();
   
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serviceId = 2;
        $request->validate([
            'complainantId' => ['nullable', 'integer'],
            'cName' => ['nullable', 'regex:/^[a-zA-ZñÑ\s]+$/','string'],
            'cAddress' => ['nullable','string'],
            'respondentId' => ['nullable', 'integer'],
            'respondents' => ['nullable','regex:/^[a-zA-ZñÑ\s]+$/','string', 'max:255'],
            'respondentsAdd' => 'nullable','string',
            'compDetails' => 'required', 'string',
        ]);

        // dd($request->all());

        if($request->complainantId != null && $request->respondentId != null)
        { // Complainant Inside / Respondent Inside
          //get inside info of respondent inside the barangay
          $respondentInfo = DB::table('users')
                            ->where('id', $request->respondentId)
                            ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 
                                      DB::raw('concat(houseNo, ", ", street) as "address"'))
                            ->first();

          $transId = Transactions::create([
            'userId' => $request->complainantId,
            'serviceId' => $serviceId,
            'status' => 'Unsettled',
            'unique_code' => sha1(time()),               
          ]);

          ComplaintsTransactions::create([  
            'transId' => $transId->id,
            'compType' => '1',
            'compDetails' => $request->compDetails,
            'respondents' => $respondentInfo->name,
            'respondentsAdd' => $respondentInfo->address,
          ]);
          return redirect('home')->with('success', 'Complaint filed successfully!');
        }
        elseif($request->complainantId != null && $request->respondents != null && $request->respondentsAdd != null)
        { // Complainant Inside / Respondent Outside
          $transId = Transactions::create([
            'userId' => $request->complainantId,
            'serviceId' => $serviceId,
            'status' => 'Unsettled',
            'unique_code' => sha1(time()),               
          ]);
        
          ComplaintsTransactions::create([  
              'transId' => $transId->id,
              'compType' => '1',
              'compDetails' => $request->compDetails,
              'respondents' => $request->respondents,
              'respondentsAdd' => $request->respondentsAdd,
          ]);
          return redirect('home')->with('success', 'Complaint filed successfully!');
        }
        elseif($request->cName != null && $request->cAddress != null && $request->respondentId != null)
        { // Complainant Outside / Respondent Inside
          //get inside info of respondent inside the barangay
          $respondentInfo = DB::table('users')
                            ->where('id', $request->respondentId)
                            ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 
                                    DB::raw('concat(houseNo, ", ", street) as "address"'))
                            ->first();

          $transId = Transactions::create([
            'userId' => $request->respondentId,
            'serviceId' => $serviceId,
            'status' => 'Unsettled',
            'unique_code' => sha1(time()),               
          ]);

          $compId = ComplaintsTransactions::create([  
            'transId' => $transId->id,
            'compType' => '0',
            'compDetails' => $request->compDetails,
            'respondents' => $respondentInfo->name,
            'respondentsAdd' => $respondentInfo->address,
          ]);

          OutsideComplainants::create([
            'compId' => $compId->id,
            'complainant' => $request->cName,
            'address' => $request->cAddress,
          ]);
          return redirect('home')->with('success', 'Complaint filed successfully!');
        }
        elseif($request->respondentId == null && $request->complainantId == null)
        {
          return redirect('complaints/create')->with('danger', 'Must contain insider complainant or respondent!');
        }
 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($compId, $userId)
    {
        $td = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('users.id', $userId)
        ->where('complaints_transactions.id', $compId)
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                DB::raw('date(complaints_transactions.updated_at) as "condition_date"'),'complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                'complaints_transactions.compDetails', 'complaints_transactions.transId', 'complaints_transactions.reason',
                'users.lastName', 'users.firstName', 'users.houseNo', 'users.street',
                'transactions.status', 'transactions.userId')
        ->first();

        $hearings = DB::table('hearings')
        ->join('complaints_transactions', 'hearings.compId', '=', 'complaints_transactions.id')
        ->where('hearings.compId', $compId)
        ->select('hearings.details', DB::raw('date(hearings.created_at) as "date"'))
        ->get();
        // dd($hearings[0]);

        $hearingCounts = $hearings->count();
        
        
        return view('complaints.show')
        ->with('td', $td)
        ->with(['hearings' => $hearings])
        ->with('hearingCounts', $hearingCounts);
    }

    public function showOutsider($compId)
    {
        $td = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('outside_complainants', 'complaints_transactions.id', '=', 'outside_complainants.compId')
        ->orderBy('complaints_transactions.id','DESC')
        ->where('complaints_transactions.id', $compId)
        ->select('complaints_transactions.id', 'complaints_transactions.transId', 'complaints_transactions.compType', 
                DB::raw('date(complaints_transactions.updated_at) as "condition_date"'),
                'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                'complaints_transactions.reason',
                DB::raw('date(complaints_transactions.created_at) as "date"'),
                'outside_complainants.complainant', 'outside_complainants.address',
                'transactions.status','transactions.userId')
        ->first();

        $hearings = DB::table('hearings')
        ->join('complaints_transactions', 'hearings.compId', '=', 'complaints_transactions.id')
        ->where('hearings.compId', $compId)
        ->select('hearings.details', DB::raw('date(hearings.created_at) as "date"'))
        ->get();
        // dd($hearings[0]);

        $hearingCounts = $hearings->count();
        
        
        return view('complaints.showoutsider')
        ->with('td', $td)
        ->with(['hearings' => $hearings])
        ->with('hearingCounts', $hearingCounts);
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

    public function settle(Request $request, $compId, $transId)
    {
        $request->validate([
          'reason' => 'required', 'string',
        ]);

        $reason = ComplaintsTransactions::where('id', $compId)->update(['reason' => $request->reason]);
        $settled = Transactions::where('id', $transId)->update(['status' => 'Settled']);
        return redirect()->back()->with('success', 'Complaint Settled!');
    }

    public function escalate(Request $request, $compId, $transId)
    {
        $request->validate([
          'reason' => 'required', 'string',
        ]);

        $reason = ComplaintsTransactions::where('id', $compId)->update(['reason' => $request->reason]);
        $settled = Transactions::where('id', $transId)->update(['status' => 'Escalated']);
        return redirect()->back()->with('warning', 'Complaint Escalated!');
    }

    public function dismiss(Request $request, $compId, $transId)
    {
        $request->validate([
          'reason' => 'required', 'string',
        ]);
        
        $reason = ComplaintsTransactions::where('id', $compId)->update(['reason' => $request->reason]);
        $settled = Transactions::where('id', $transId)->update(['status' => 'Dismissed']);
        return redirect()->back()->with('danger', 'Complaint Dismissed!');
    }

    public function recordHearing(Request $request, $compId, $transId)
    {
        $request->validate([
            'details' => 'required',
        ]);

        Hearings::create([
            'compId' => $compId,
            'details' => $request->details,
        ]);

        $onGoing = Transactions::where('id', $transId)->update(['status' => 'On Going']);

        return redirect()->back()->with('success', 'Hearing Details Recorded!');
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
