<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\News;
use App\Models\NewsPhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id','ASC')->get();
        $users = User::all();

        return view('news.index',[
            'news' => $news,
            'users' => $users,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
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
            'type' => 'required',
            'title' => 'required', 'unique:news',
            'description' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
        ]);

        $news = News::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'userId' => Auth::user()->id,
        ]);

        if($request->images)
        {
           foreach($request->images as $image)
           {
                $newsPhotoPath = $image->store('news/'.$request->title,'public');
                NewsPhoto::create([
                  'path' => $newsPhotoPath,
                  'newsId' => $news->id,
                ]);
           }
        }

        return redirect()->route('news.index')->with('success','News created successfully');
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
         $news = News::where('id', $id)->first();
         $photos[] = NewsPhoto::selectRaw('path')->where('newsId', $id)->get();

         return view('news.edit', ['news' => $news, 'photos' => $photos[0]]);
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
         $news = News::selectRaw('*')->where('id', $id)->first();
         $photos = NewsPhoto::selectRaw('*')->where('newsId', $id)->get();
       
         // dd($request->all(), $r);

         $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
         ]);

         if($request->images)
         {
            foreach($photos as $photo)
            {
               File::delete('storage/'.$photo->path);
               $photo->delete();
            }
            
            foreach($request->images as $image)
            {
               $newsPhotoPath = $image->store('news/'.$request->title,'public');
               NewsPhoto::create([
                  'path' => $newsPhotoPath,
                  'newsId' => $news->id,
               ]);
            }

            $news = News::where('id', $id)->update([
               'title' => $request->title,
               'description' => $request->description,
            ]);
         }
         else
         {
            $news = News::where('id', $id)->update([
               'title' => $request->title,
               'description' => $request->description,
            ]);
         }

         return redirect()->route('news.index')->with('success','News edited successfully');

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
