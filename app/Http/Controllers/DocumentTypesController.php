<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentTypes;

class DocumentTypesController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('permission:documents-types',['only' => 'index']);
        $this->middleware('permission:documents-types-create', ['only' => ['create','store']]);
        $this->middleware('permission:documents-types-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:documents-types-delete', ['only' => ['destroy']]);
        // $this->middleware();
    }
    public function index(Request $request)
    {
        $td = DB::table('document_types')
              ->wherenull('deleted_at')
              ->select('id', 'docType', 'price')
              ->paginate(10);
        return view('doctypes.index', compact('td'))
              ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'docType' => 'required','regex:/^[a-zA-ZñÑ\s]+$/',
          'template' => 'required', 'string',
          'price' => 'required', 'float',
        ]);

        DocumentTypes::create([
          'docType' => $request->docType,
          'template' => $request->template,
          'price' => $request->price,
        ]);

        return redirect('doctypes/create')->with('success', 'Document Type added successfully!');
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
        $td = DB::table('document_types')
        ->where('id', $id)
        ->select('id', 'docType', 'template', 'price')
        ->first();

        return view('doctypes.edit')->with('td', $td);
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
      $request->validate([
        'docType' => 'required','regex:/^[a-zA-ZñÑ\s]+$/',
        'template' => 'required', 'string',
        'price' => 'required', 'float',
      ]);

      $doc = DocumentTypes::find($id);

      $doc->update([
        'docType' => $request->docType,
        'template' => $request->template,
        'price' => $request->price,
      ]);

      return redirect('doctypes')->with('success', 'Document Type edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $docType = DocumentTypes::where('id',$id)->first();
      if($docType->delete())
          return redirect()->route('doctypes.index')->with('danger','Document Type deleted successfully');
      else
          abort(404);
    }
}
