<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kendaraans'] = Kendaraan::orderBy('id','desc')->simplePaginate(5);
    
        return view('mobil.index', $data)
            ->with('i',(request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobil.create');
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
            'tanggal' => 'required',
            'waktu' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'no_polisi' => 'required'
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('mobil.index')
            ->with('success', 'Data kendaraan telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        return view('mobil.show', compact('kendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan, $id)
    {
        $kendaraan = Kendaraan::find($id);
        return view('mobil.edit', compact('kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'tanggal',
            'waktu' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'no_polisi' => 'required'
        ]);
        $kendaraan->update($request->all());

        return redirect()->route('mobil.index')
            ->with('success', 'Data kendaraan telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan, $id)
    {
        $kendaraan = Kendaraan::find($id);
        $kendaraan->delete();

        return redirect()->route('mobil.index')
            ->with('success', 'Data kendaraan telah dihapus');
    }
}
