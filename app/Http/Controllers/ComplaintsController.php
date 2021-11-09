<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;
// use App\Models\AvailedServices;
use App\Models\ComplaintsTransactions;
use App\Models\OutsideComplainants;
use App\Models\InsideRespondents;
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
        $this->middleware('permission:module-file-complaint', ['only' => ['create','store']]);
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
        if($request->input('from') && $request->input('to')){

            $fromDate = $request->input('from') . ' 00:00:00';
            $toDate = $request->input('to') . ' 23:59:59';

            $data = DB::table('complaints_transactions')
            ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->orderBy('complaints_transactions.id','DESC')
            ->where('complaints_transactions.compType', 1)
            ->where('complaints_transactions.created_at', '>=', $fromDate)
            ->where('complaints_transactions.created_at', '<=', $toDate)
            ->select('complaints_transactions.id', 'complaints_transactions.transId', 
                    'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                    DB::raw('date(complaints_transactions.created_at) as "date"'),
                    'users.firstName','users.lastName', 'users.houseNo', 'users.street', 
                    'transactions.status','transactions.userId')
            ->get();
            // $data->appends($request->all());

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
            ->get();
        }
        return view('complaints.index', compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function outsider(Request $request)
    {
      //Non-Residential Function
        if($request->input('from') && $request->input('to')){
            $fromDate = $request->input('from') . ' 00:00:00';
            $toDate = $request->input('to') . ' 23:59:59';

            $data = DB::table('complaints_transactions')
            ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->join('outside_complainants', 'complaints_transactions.id', '=', 'outside_complainants.compId')
            ->orderBy('complaints_transactions.id','DESC')
            ->where('complaints_transactions.compType', 0)
            ->where('complaints_transactions.created_at', '>=', $fromDate)
            ->where('complaints_transactions.created_at', '<=', $toDate)
            ->select('complaints_transactions.id', 'complaints_transactions.transId', 
                    'complaints_transactions.compDetails','complaints_transactions.respondents', 'complaints_transactions.respondentsAdd',
                    DB::raw('date(complaints_transactions.created_at) as "date"'),
                    'outside_complainants.complainant','outside_complainants.address',  
                    'transactions.status','transactions.userId')
            ->get();
        }
        else
        {
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
          ->get();
        }
        return view('complaints.outsider', compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 6);
    }

    public function getDocData($compId, $transId)
    {
        $td = DB::table('complaints_transactions')
        ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('transactions.id', $transId)
        ->where('complaints_transactions.id', $compId)
        ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
                'complaints_transactions.respondents', 'complaints_transactions.respondentsAdd','complaints_transactions.reason',
                'complaints_transactions.compDetails','users.lastName', 'users.firstName', 'users.houseNo', 'users.street','transactions.unique_code')
        ->first();
        // dd($transId,$userId);
        $brgy = DB::table('barangay')
        ->select('id', 'name', 'zipCode', 'city', 'province', 'region', 
                'logoPath', 'cityLogoPath')
        ->first();

        $path1 = base_path('public/images/'.$brgy->logoPath);
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $brgyLogo = 'data:image/' .$type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/images/'.$brgy->cityLogoPath);
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $cityLogo = 'data:image/' .$type2 . ';base64,' . base64_encode($data2);
        
        $officials = DB::table('barangay_officials')
        ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 'position')
        ->get();

        return compact('td', 'officials', 'brgy', 'brgyLogo', 'cityLogo');
    }

    public function getOutsideDocData($compId, $transId)
    {
      //Non-Residential Function
      $td = DB::table('complaints_transactions')
      ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id')
      ->join('users', 'users.id', '=', 'transactions.userId')
      ->join('outside_complainants', 'outside_complainants.compId', '=', 'complaints_transactions.id')
      ->where('transactions.id', $transId)
      ->where('complaints_transactions.id', $compId)
      ->select('complaints_transactions.id', DB::raw('date(complaints_transactions.created_at) as "date"'), 
              'complaints_transactions.respondents', 'complaints_transactions.respondentsAdd','complaints_transactions.reason',
              'complaints_transactions.compDetails', 
              'outside_complainants.complainant', 'outside_complainants.address',
              'transactions.unique_code')
      ->first();
      
      $brgy = DB::table('barangay')
      ->select('id', 'name', 'zipCode', 'city', 'province', 'region', 
              'logoPath', 'cityLogoPath')
      ->first();

      $path1 = base_path('public/images/'.$brgy->logoPath);
      $type1 = pathinfo($path1, PATHINFO_EXTENSION);
      $data1 = file_get_contents($path1);
      $brgyLogo = 'data:image/' .$type1 . ';base64,' . base64_encode($data1);

      $path2 = base_path('public/images/'.$brgy->cityLogoPath);
      $type2 = pathinfo($path2, PATHINFO_EXTENSION);
      $data2 = file_get_contents($path2);
      $cityLogo = 'data:image/' .$type2 . ';base64,' . base64_encode($data2);
      
      $officials = DB::table('barangay_officials')
      ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 'position')
      ->get();

      return compact('td', 'officials', 'brgy', 'brgyLogo', 'cityLogo');
    }

    public function pdfViewComplaint($compId, $transId) 
    {
        $document = $this->getDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        
        return view('complaints.form')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfViewOutsideComplaint($compId, $transId) 
    {
      //Non-Residential Function
        $document = $this->getOutsideDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.oform')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfSaveComplaint($compId, $transId) 
    {
        $document = $this->getDocData($compId, $transId); 
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];
        
        $pdf = PDF::loadView('complaints.form', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.'-'.'Complaint-Form.pdf');
    }

    public function pdfSaveOutsideComplaint($compId, $transId) 
    {
      //Non-Residential Function
        $document = $this->getOutsideDocData($compId, $transId); 
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];

        $pdf = PDF::loadView('complaints.oform', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->complainant.'-'.'Complaint-Form.pdf');
    }

    public function pdfViewEscalate($compId, $transId)
    {
        $document = $this->getDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.escalate')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfViewOutsideEscalate($compId, $transId)
    {
        $document = $this->getOutsideDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.oescalate')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfSaveEscalate($compId, $transId)
    {
        $document = $this->getDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];

        $pdf = PDF::loadView('complaints.escalate', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.$td->firstName.'-'.'Escalation-Form.pdf');
    }

    public function pdfSaveOutsideEscalate($compId, $transId)
    {
       //Non-Residential Function
        $document = $this->getOutsideDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];

        $pdf = PDF::loadView('complaints.oescalate', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->complainant.'-'.'Escalation-Form.pdf');
    }

    public function pdfViewSettle($compId, $transId)
    {
        $document = $this->getDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.settle')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfViewOutsideSettle($compId, $transId)
    {
       //Non-Residential Function
        $document = $this->getOutsideDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        return view('complaints.osettle')->with('td', $td)->with('officials', $officials)->with('brgy', $brgy);
    }

    public function pdfSaveSettle($compId, $transId)
    {
        $document = $this->getDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];

        $pdf = PDF::loadView('complaints.settle', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.'-'.'Settlement-Form.pdf');
    }

    public function pdfSaveOutsideSettle($compId, $transId)
    {
       //Non-Residential Function
        $document = $this->getOutsideDocData($compId, $transId);
        $td = $document['td'];
        $officials = $document['officials'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];

        $pdf = PDF::loadView('complaints.osettle', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td, 'officials' => $officials, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->complainant.'-'.'Settlement-Form.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->where('id', '>', 1)->sortBy('lastName');
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
        // $serviceId = 2;
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
            // 'serviceId' => $serviceId,
            'status' => 'Unresolved',
            'unique_code' => sha1(time()),               
          ]);

          $compId = ComplaintsTransactions::create([  
            'transId' => $transId->id,
            'compType' => '1',
            'compDetails' => $request->compDetails,
            'respondents' => $respondentInfo->name,
            'respondentsAdd' => $respondentInfo->address,
          ]);

          InsideRespondents::create([
             'compId' => $compId->id,
             'userId' => $request->respondentId,
          ]);

          return redirect('home')->with('success', 'Complaint filed successfully!');
        }
        elseif($request->complainantId != null && $request->respondents != null && $request->respondentsAdd != null)
        { // Complainant Inside / Respondent Outside
          $transId = Transactions::create([
            'userId' => $request->complainantId,
            // 'serviceId' => $serviceId,
            'status' => 'Unresolved',
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
            // 'serviceId' => $serviceId,
            'status' => 'Unresolved',
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

          InsideRespondents::create([
            'compId' => $compId->id,
            'userId' => $request->respondentId,
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
        return redirect()->back()->with('warning', 'Complaint Dismissed!');
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
