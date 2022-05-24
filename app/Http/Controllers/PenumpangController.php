<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['penumpangs'] = Penumpang::orderBy('id','desc')->simplePaginate(5);
    
        return view('penumpangs.index', $data)
            ->with('i',(request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penumpangs.create');
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
            'nama' => 'required',
            'jk' => 'required',
            'umur' => 'required',
            'alamat' => 'required'
        ]);

        Penumpang::create($request->all());

        return redirect()->route('penumpangs.index')
            ->with('success', 'Data penumpang telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penumpang $penumpang)
    {
        return view('penumpangs.show', compact('penumpang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penumpang $penumpang)
    {
        return view('penumpangs.edit', compact('penumpang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penumpang $penumpang)
    {
        $request->validate([
           'nama' => 'required',
            'jk' => 'required',
            'umur' => 'required',
            'alamat' => 'required'
        ]);
        $penumpang->update($request->all());

        return redirect()->route('penumpangs.index')
            ->with('success', 'Data penumpang telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penumpang $penumpang)
    {
        $penumpang->delete();

        return redirect()->route('penumpangs.index')
            ->with('success', 'Data penumpang telah dihapus.');
    }
}
