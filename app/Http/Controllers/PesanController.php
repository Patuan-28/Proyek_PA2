<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(){
         return view('pemesanan.booking');
    }

    public function store(Request $request){
        $data = $request->all();
        
        // dd($data);
        $this->validate($request,[
            'tanggal' => 'required',
            'waktu' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'no_polisi' => 'required'
        ]);

        $kendaraan = new Kendaraan;
        $kendaraan->tanggal = $data['tanggal'];
        $kendaraan->waktu = $data['waktu'];
        $kendaraan->nama = $data['nama'];
        $kendaraan->jenis = $data['jenis'];
        $kendaraan->no_polisi = $data['no_polisi'];
        $kendaraan->save();

        $request->validate([
            'addMoreInputFields.*.nama' => 'required',
            'addMoreInputFields.*.jk' => 'required',
            'addMoreInputFields.*.umur' => 'required',
            'addMoreInputFields.*.alamat' => 'required',
        ]);
     
        foreach ($request->addMoreInputFields as $key => $value) {
            Penumpang::create($value);
        }
     
        return back()->with('success', 'Pesan telah dibuat');
    }


    // public function store(Request $request){
        
    //     $data = $request->all();
        
    //     // dd($data);
    //     $this->validate($request,[
    //         'tanggal' => 'required',
    //         'waktu' => 'required',
    //         'nama' => 'required',
    //         'jenis' => 'required',
    //         'no_polisi' => 'required'
    //     ]);

    //     $kendaraan = new Kendaraan;
    //     $kendaraan->tanggal = $data['tanggal'];
    //     $kendaraan->waktu = $data['waktu'];
    //     $kendaraan->nama = $data['nama'];
    //     $kendaraan->jenis = $data['jenis'];
    //     $kendaraan->no_polisi = $data['no_polisi'];
    //     $kendaraan->save();

    // // Kendaraan::create($request->all());

    //      $this->validate($request,[
    //         'nama' => 'required',
    //         'jk' => 'required',
    //         'umur' => 'required',
    //         'alamat' => 'required'
    //     ]);

    //     //  foreach ($this->nama as $key => $value) {
    //     //     Penumpang::create(['nama' => $this->nama[$key], 'jk' => $this->jk[$key],'nama' => $this->nama[$key],'umur' => $this->umur[$key],'alamat' => $this->alamat[$key]]);
    //     // }

    //     foreach($request->nama as $key => $value){
    //         $penumpang = new Penumpang;    
    //         $penumpang->nama = $value;
    //         $penumpang->jk = $value;
    //         $penumpang->umur = $value;
    //         $penumpang->alamat = $value;
    //         $penumpang->save();
    //     }
    // // foreach ($_POST['nama'] as $key => $value) {
    // // $penumpang = new Penumpang;
    // //         $penumpang->nama = $data['nama'];
    // //         $penumpang->jk = $data['jk'];
    // //         $penumpang->umur = $data['umur'];
    // //         $penumpang->alamat = $data['alamat'];
    // //         $penumpang->save();
    // //                         }
        

    // // $request->validate([
    // //     'nama' => 'required',
    // //     'jk' => 'required',
    // //     'umur' => 'required',
    // //     'alamat' => 'required'
    // // ]);

    // // Penumpang::create($request->all());

    // return redirect()->back()->with('status','Data Berhasil Dimasukkan');
    // }
}
