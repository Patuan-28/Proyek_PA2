<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['profiles'] = Profile::orderBy('id','desc')->simplePaginate(5);
    
        return view('profiles.index', $data)
            ->with('i',(request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
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
          'title' => 'required',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
        'content' => 'required'
        ]);
        $path = $request->file('image')->store('public/images');
        $profile = new Profile();
        $profile->title = $request->title;
        $profile->content = $request->content;
        $profile->image = $path;
        $profile->save();
    
        return redirect()->route('profiles.index')
                        ->with('success','Data profile telah dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profiles.show',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit',compact('profile'));
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
            'title' => 'required',
        ]);
        
        $profile = Profile::find($id);
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
            ]);
            $path = $request->file('image')->store('public/images');
            $profile->image = $path;
        }
        $profile->title = $request->title;
        $profile->content = $request->content;
        $profile->save();
    
        return redirect()->route('profiles.index')
                        ->with('success','Data profile telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
    
        return redirect()->route('profiles.index')
                        ->with('success','Data profile telah dihapus.');
    }
}
