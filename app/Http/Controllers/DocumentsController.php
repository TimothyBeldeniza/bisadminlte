<?php

namespace App\Http\Controllers;

use Auth;
use App\Events\ProcessRequestedDocument;
use App\Events\SubmitRequest;
use App\Jobs\RequestedDocumentJob;
use App\Jobs\SendQrEmail;
use App\Models\Barangay;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\User;
// use App\Models\AvailedServices;
use App\Models\DocumentsTransactions;
use App\Models\DocumentTypes;
use App\Models\Services;
use App\Models\BarangayOfficials;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Hash;

use PDF;

class DocumentsController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('permission:module-request-document', ['only' => ['create','store']]);
        $this->middleware('permission:module-document-records',['only' => 'index']);
        // $this->middleware('permission:documents-show-ID', ['only' => ['create','store']]);
        $this->middleware('permission:documents-process',['only' => 'process']);
        $this->middleware('permission:documents-view', ['only' => 'pdfViewDocument']);
        $this->middleware('permission:documents-save-PDF',['only' => 'pdfSaveDocument']);
        $this->middleware('permission:documents-disapprove',['only' => 'disapproved']);
        $this->middleware('permission:documents-scan-document',['only' => 'scan']);
        $this->middleware('permission:documents-scan-request',['only' => 'scanReq']);
        // $this->middleware();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('from') && $request->input('to') ){

            $fromDate = $request->input('from') . ' 00:00:00';
            $toDate = $request->input('to') . ' 23:59:59';

            $data = DB::table('documents_transactions')
            ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
            ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
            ->join('users', 'users.id', '=', 'transactions.userId')
            ->whereNull('document_types.deleted_at')
            ->where('documents_transactions.updated_at', '>=', $fromDate)
            ->where('documents_transactions.updated_at', '<=', $toDate)
            ->orderBy('documents_transactions.id','DESC')
            ->select('documents_transactions.id', 'documents_transactions.transId', 'documents_transactions.purpose', 
                    'documents_transactions.barangayIdPath', DB::raw('date(documents_transactions.created_at) as "date"'),
                    'users.firstName', 'users.lastName', 'users.email', 
                    'transactions.status', 'transactions.userId', DB::raw('date(transactions.updated_at) as "releaseDate"'),
                    'document_types.docType','document_types.price')
            ->get();

            $totalRevenue = [
               'due' => DB::table('documents_transactions')
                        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
                        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
                        ->join('users', 'users.id', '=', 'transactions.userId')
                        ->whereNull('document_types.deleted_at')
                        ->where('documents_transactions.updated_at', '>=', $fromDate)
                        ->where('documents_transactions.updated_at', '<=', $toDate)
                        ->where('transactions.status', 'For Validation')
                        ->orWhere('transactions.status', 'Ready to Claim')
                        ->select(DB::raw('sum(document_types.price) as "totalDue"'))
                        ->first(),
               
               'paid' => DB::table('documents_transactions')
                        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
                        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
                        ->join('users', 'users.id', '=', 'transactions.userId')
                        ->whereNull('document_types.deleted_at')
                        ->where('documents_transactions.updated_at', '>=', $fromDate)
                        ->where('documents_transactions.updated_at', '<=', $toDate)
                        ->where('transactions.status', 'Paid')
                        ->orWhere('transactions.status', 'Released')
                        ->select(DB::raw('sum(document_types.price) as "totalPaid"'))
                        ->first(),
            ];

        }
        else 
        {
            $data = DB::table('documents_transactions')
            ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
            ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
            ->join('users', 'users.id', '=', 'transactions.userId')
            ->whereNull('document_types.deleted_at')
            ->orderBy('documents_transactions.id','DESC')
            ->select('documents_transactions.id', 'documents_transactions.transId', 'documents_transactions.purpose', 
                    'documents_transactions.barangayIdPath', DB::raw('date(documents_transactions.created_at) as "date"'),
                    'users.firstName', 'users.lastName', 'users.email', 
                    'transactions.status', 'transactions.userId', DB::raw('date(transactions.updated_at) as "releaseDate"'),
                    'document_types.docType','document_types.price')
            ->get();

            $totalRevenue = [
               'revenue' => DB::table('documents_transactions')
                           ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
                           ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
                           ->join('users', 'users.id', '=', 'transactions.userId')
                           ->whereNull('document_types.deleted_at')
                           ->select(DB::raw('sum(document_types.price) as "revenue"'))
                           ->first(),

               'due' => DB::table('documents_transactions')
                        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
                        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
                        ->join('users', 'users.id', '=', 'transactions.userId')
                        ->whereNull('document_types.deleted_at')
                        ->where('transactions.status', 'For Validation')
                        ->orWhere('transactions.status', 'Ready to Claim')
                        ->select(DB::raw('sum(document_types.price) as "totalDue"'))
                        ->first(),
               
               'paid' => DB::table('documents_transactions')
                        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
                        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
                        ->join('users', 'users.id', '=', 'transactions.userId')
                        ->whereNull('document_types.deleted_at')
                        ->where('transactions.status', 'Paid')
                        ->orWhere('transactions.status', 'Released')
                        ->select(DB::raw('sum(document_types.price) as "totalPaid"'))
                        ->first(),
            ];

            // dd($totalRevenue);
        }

        return view('documents.index', compact('data', 'totalRevenue'))
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function getDocData($transId, $userId)
    {
        $td = DB::table('documents_transactions')
        ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
        ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
        ->join('users', 'users.id', '=', 'transactions.userId')
        ->where('users.id', $userId)
        ->where('documents_transactions.id', $transId)
        ->select('documents_transactions.id', DB::raw('date(documents_transactions.created_at) as "date"'), 
                'documents_transactions.purpose', 'document_types.docType', 'document_types.template',
                'users.lastName', 'users.firstName', 'users.civilStatus', 'users.citizenship', 'users.houseNo', 'users.street',
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

        //generating dynamic document values
        $values = [
          //Users
          'lastName' => $td->lastName,
          'firstName' => $td->firstName,
          'civilStatus' => $td->civilStatus,
          'citizenship' => $td->citizenship,
          'houseNo' => $td->houseNo,
          'street' => $td->street,
          'purpose' => $td->purpose,
          //Brgy
          'brgy' => $brgy->name,
          'city' => $brgy->city,
          'province' => $brgy->province,
        ];
      
        $template = $td->template;
      
        $result = preg_replace_callback(
          '#<<(\w+)>>#',
          function (array $matches) use ($values): string {
            [$tag, $tagName] = $matches;
            return $values[$tagName] ?? $tag;
          },
          $template
        );
        //end of generating

        $officials = DB::table('barangay_officials')
        ->select(DB::raw('concat(firstName, " ", lastName) as "name"'), 'position')
        ->get();
        
        return compact('td', 'officials', 'result', 'brgy', 'brgyLogo', 'cityLogo');
    }

    public function pdfViewDocument($transId, $userId) 
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $template = $document['result'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];
        
        return view('documents.document')
        ->with('td', $td)
        ->with('officials', $officials)
        ->with('template', $template)
        ->with('brgy', $brgy)
        ->with('cityLogoPath', $cityLogo)
        ->with('brgyLogoPath', $brgyLogo);
    }

    public function pdfSaveDocument($transId, $userId) 
    {
        $document = $this->getDocData($transId, $userId);
        $td = $document['td'];
        $officials = $document['officials'];
        $template = $document['result'];
        $brgy = $document['brgy'];
        $brgyLogo = $document['brgyLogo'];
        $cityLogo = $document['cityLogo'];
        
      //   dd($cityLogo, $brgyLogo);
        // dd($td);
        // $pdf = PDF::loadView('documents.document')->with('td', $td)->with('officials', $officials);
        $pdf = PDF::loadView('documents.document', ['cityLogoPath' => $cityLogo,'brgyLogoPath' => $brgyLogo, 'td' => $td,  'officials' => $officials, 'template' => $template, 'brgy' => $brgy])->setPaper('a4', 'portrait');
        return $pdf->download($td->lastName.'-'.$td->firstName.'-'.$td->docType.'-'.'Document.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $currentUser = Auth::user()->id;
        $doctypes = DocumentTypes::select('id','docType', 'price')->get();

      //   $case = DB::table('complaints_transactions')
      //             ->join('transactions', 'complaints_transactions.transId', '=', 'transactions.id') 
      //             ->join('inside_respondents', 'inside_respondents.compId', '=', 'complaints_transactions.id')
      //             ->where('inside_respondents.userId', 1)
      //             ->where('transactions.sttus', 'Unresolved')
      //             ->orWhere('transactions.status', 'On Going')
      //             ->select('complaints_transactions.id', 'transactions.status')
      //             ->get();

      $case = DB::table('inside_respondents')
               ->join('complaints_transactions', 'complaints_transactions.id', '=', 'inside_respondents.compId') 
               ->join('transactions', 'transactions.id', '=', 'complaints_transactions.transId')
               ->where('inside_respondents.userId', $currentUser)
               ->orderBy('inside_respondents.compId', 'DESC')
               ->select('inside_respondents.compId', 'transactions.status')
               ->get();

      //   dd($currentUser);

        if($case->count() > 0)
        {   
           if($case[0]->status == "Unresolved" || $case[0]->status == "On Going")
           {
              $hasCase = true;
              return view('documents.create', compact('doctypes'))->with('hasCase', $hasCase);
           }
           elseif($case[0]->status == "Dismissed" || $case[0]->status == "Settled" || $case[0]->status == "Escalated")
           {
              $hasCase = false;
              return view('documents.create', compact('doctypes'))->with('hasCase', $hasCase);
           }
        }
        else
        {
           $hasCase = false;
           return view('documents.create', compact('doctypes'))->with('hasCase', $hasCase);
        }
    }

    public function walkin()
    { 
         $users = User::all()->where('id', '>', 1)->sortBy('lastName');

         $doctypes = DocumentTypes::select('id','docType', 'price')->get();

         $noCases = array();
         $hasCases = array();

         foreach($users as $user)
         {
            $case = DB::table('inside_respondents')
                  ->join('complaints_transactions', 'complaints_transactions.id', '=', 'inside_respondents.compId') 
                  ->join('transactions', 'transactions.id', '=', 'complaints_transactions.transId')
                  ->where('inside_respondents.userId', $user->id)
                  ->orderBy('inside_respondents.compId', 'DESC')
                  ->select('inside_respondents.compId', 'transactions.status')
                  ->get();

            if($case->count() > 0)
            {   
               if($case[0]->status == "Unresolved" || $case[0]->status == "On Going")
               {
                  $hasCases[] = $user;
               }
               elseif($case[0]->status == "Dismissed" || $case[0]->status == "Settled" || $case[0]->status == "Escalated")
               {
                  $noCases[] = $user;
               }
            }
            else
            {
               $noCases[] = $user;
            }
         }

         // dd($users, $case, $noCases, $hasCases);

         return view('documents.walkin', compact('doctypes', 'users', 'hasCases', 'noCases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $userId = Auth::User()->id;
        $email = Auth::User()->email;
        $name  = Auth::User()->firstName . ' ' . Auth::User()->lastName;
        $brgyName = Barangay::find(1)->pluck('name')->first(); 
        $unique_code = sha1($email.time().$userId);
        
        $request->validate([
           'docType' => 'required', 'integer',
           'user' => 'nullable', 'integer',
           'purpose' => 'required', 'string', 'regex:/^[a-zA-ZñÑ\s]+$/',
           'others' => ['nullable', 'string', 'regex:/^[a-zA-ZñÑ\s]+$/'],
           'image' => 'mimes:jpg,png,jpeg|max:5048',
        ]);

        $getDocument = DocumentTypes::find($request->docType);
        $document = $getDocument->docType;

        if($request->user != null)
        {
            // $walkinUser = User::find($request->user);
            // $wname = $walkinUser->firstName . ' ' . $walkinUser->lastName;
            // $transId = Transactions::create([
            //    'userId' => $request->user,
            //    'status' => 'Due',
            //    'unique_code' => sha1(time()),
            // ]);

            $case = DB::table('inside_respondents')
               ->join('complaints_transactions', 'complaints_transactions.id', '=', 'inside_respondents.compId') 
               ->join('transactions', 'transactions.id', '=', 'complaints_transactions.transId')
               ->where('inside_respondents.userId', $request->user)
               ->orderBy('inside_respondents.compId', 'DESC')
               ->select('inside_respondents.compId', 'transactions.status')
               ->get();
            // dd($case);
            if($case->count() > 0)
            {   
               if($case[0]->status == "Unresolved" || $case[0]->status == "On Going")
               {
                  return redirect()->back()->with('warning', 'Resident have Unresolved or On Going Cases. Please get them to process them first.');
               }
               elseif($case[0]->status == "Dismissed" || $case[0]->status == "Settled" || $case[0]->status == "Escalated")
               {
                  $hasCase = false;
                  $walkinUser = User::find($request->user);
                  $wname = $walkinUser->firstName . ' ' . $walkinUser->lastName;
                  $transId = Transactions::create([
                     'userId' => $request->user,
                     'status' => 'Ready to Claim',
                     'unique_code' => sha1(time()),
                  ]);
               }
            }
            else
            {
               $hasCase = false;
               $walkinUser = User::find($request->user);
               $wname = $walkinUser->firstName . ' ' . $walkinUser->lastName;
               $transId = Transactions::create([
                  'userId' => $request->user,
                  'status' => 'Ready to Claim',
                  'unique_code' => sha1(time()),
               ]);
            }
            
        }
        else
        {
           $transId = Transactions::create([
             'userId' => $userId,
             'status' => 'For Validation',
             'unique_code' => sha1(time()),
           ]);
        }

        if($request->image)
        {
            // $newImageName = time() . '-' . $request->lastName . '.' . $request->firstName . '.' . $request->middleName . '.' .$request->image->extension();
            // $request->image->move(public_path('images/barangayId'), $newImageName);
            $barangayIdPath = $request->image->store('barangay_id','public');
            // dd($barangayIdPath);
            if($request->others != null)
            {
                DocumentsTransactions::create([
                    'transId' => $transId->id,
                    'dmId' => $request->docType,
                    'purpose' => $request->others,
                    'barangayIdPath' => $barangayIdPath,
                ]);
            }
            else
            {
                DocumentsTransactions::create([
                    'transId' => $transId->id,
                    'dmId' => $request->docType,
                    'purpose' => $request->purpose,
                    'barangayIdPath' => $barangayIdPath,
                ]);
            }
            
            // event(new SubmitRequest($email,$unique_code,$name,$brgyName,$document));

            dispatch(new SendQrEmail($email,$unique_code,$name,$brgyName,$document));

            return redirect('home')->with('success', 'Document requested successfully!');
        }
        else
        {
            if($request->others != null)
            {
                DocumentsTransactions::create([
                    'transId' => $transId->id,
                    'dmId' => $request->docType,
                    'purpose' => $request->others,
                ]);
            }
            else
            {
                DocumentsTransactions::create([
                    'transId' => $transId->id,
                    'dmId' => $request->docType,
                    'purpose' => $request->purpose,
                ]);
            }

            if($request->user != null)
            //    event(new SubmitRequest($walkinUser->email,$unique_code,$wname,$brgyName,$document));
               dispatch(new SendQrEmail($walkinUser->email,$unique_code,$name,$brgyName,$document));
            else
            //    event(new SubmitRequest($email,$unique_code,$name,$brgyName,$document));
               dispatch(new SendQrEmail($email,$unique_code,$name,$brgyName,$document));
            return redirect('home')->with('success', 'Document requested successfully!');
        }
        
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
    public function update($id, $userId)
    {
        //
    }

    public function reason(Request $request, $docId, $transId, $userId)
    {
        $request->validate([
            'reason' => 'string',
            'otherReason' => ['nullable', 'string', 'regex:/^[a-zA-ZñÑ\s]+$/'],
            'submit' => 'string',
        ]);

        if($request->otherReason == null)
        {
            if($request->submit == 'process')
            {
               DocumentsTransactions::where('id', $docId)->update(['reason' => 'Adequate Requirements']);
            }
            else if($request->submit == 'disapprove')
            {
               DocumentsTransactions::where('id', $docId)->update(['reason' => $request->reason]);
            }
            else
            {
               DocumentsTransactions::where('id', $docId)->update(['reason' => $request->reason]);       
            }
        }
        else    
        {
            DocumentsTransactions::where('id', $docId)->update(['reason' => $request->otherReason]);  
        }

        if($request->submit == 'process')
        {
            $this->process($transId, $userId);
            return redirect()->back()->with('success', 'Document is ready to claim and User is emailed!');
        }
        else if($request->submit == 'disapprove')
        {
            $this->disapproved($transId);
            return redirect()->back()->with('error', 'Document diapproved!');
        }
        else if($request->submit == 'cancel')
        {
            $this->cancel($transId);
            return redirect('home')->with('error', 'Document Request Cancelled!');
        } 
    }

    public function process($transId, $userId)
    {
        $rtc = Transactions::where('id', $transId)->update(['status' => 'Ready to Claim']);

        $email = User::where('id', $userId)->pluck('email')->all();

        $name = User::where('id', $userId)->pluck('firstName')->first();

        $brgy = Barangay::find(1)->pluck('name')->first(); 
        
        $getUniqueCode = Transactions::find($transId);

        $unique_code = $getUniqueCode->unique_code;
        
        // event(new ProcessRequestedDocument($email,$unique_code,$name,$brgy));

        dispatch(new RequestedDocumentJob($email,$unique_code,$name,$brgy));
    }
    
    public function disapproved($transId)
    {
        $paid = Transactions::where('id', $transId)->update(['status' => 'Disapproved']);
    }
    
    public function cancel($transId)
    {
        $cancel = Transactions::where('id', $transId)->update(['status' => 'Cancelled']);
        return redirect()->back()->with('warning', 'Document is now Cancelled!');
    }

    public function paid($transId)
    {
        $paid = Transactions::where('id', $transId)->update(['status' => 'Paid']);
        return redirect()->back()->with('success', 'Document Paid!');
    }

    public function release($transId)
    {
       $release = Transactions::where('id', $transId)->update(['status' => 'Released']);
       return redirect()->back()->with('success', 'Document Released!');
    }

    public function checkDoc(Request $request)
    {
        $result = Transactions::where('unique_code',$request->input('code'))->pluck('unique_code')->toArray();
        $status = Transactions::where('unique_code',$request->input('code'))->pluck('status')->first();
        return view('scanner.resultView', ['result' => $result, 'status' => $status]);
    }
    public function scan()
    {
        $instascanJS = true;
        return view('scanner.scanView', compact('instascanJS'));
    }

    public function checkReq(Request $request)
    {
        // $result = Transactions::where('unique_code',$request->input('code'))->pluck('id')->toArray();
        // dd($result);

        $data = DB::table('documents_transactions')
            ->join('transactions', 'documents_transactions.transId', '=', 'transactions.id')
            ->join('document_types', 'documents_transactions.dmId', '=', 'document_types.id')
            ->join('users', 'transactions.userId', '=', 'users.id')
            ->where('transactions.unique_code', $request->input('code'))
            ->orderBy('documents_transactions.id','DESC')
            ->select('documents_transactions.id', 'documents_transactions.transId', 'documents_transactions.purpose', 
                    'documents_transactions.barangayIdPath', 'documents_transactions.reason', DB::raw('date(documents_transactions.created_at) as "date"'),
                    'users.firstName', 'users.lastName', 'users.email', 'users.profilePath', 
                    'transactions.status', 'transactions.userId', DB::raw('date(transactions.updated_at) as "releaseDate"'),
                    'document_types.docType', 'document_types.price')
            ->first();
        
        // dd($data);

        if($data){
            return view('request.resultRequest',['data' => $data]);
        }
        else {
            return view('request.resultRequestNull',['data' => $data]);
        }

    }
    public function scanReq()
    {
        $instascanJS = true;
        return view('request.scanRequest', compact('instascanJS'));
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
