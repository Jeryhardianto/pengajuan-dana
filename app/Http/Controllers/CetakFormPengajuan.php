<?php

namespace App\Http\Controllers;

use App\Models\BuktiCair;
use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class CetakFormPengajuan extends Controller
{
    public function index(Request $request){

        $id = $request->input('id');
        $pengajuan = Pengajuan::where('id', $id)->first();
        $detailItems = DetailPengajuan::where('pengajuan_id', $id)->get();
     
        return view('cetak.pengajuan-cetak', compact('pengajuan', 'detailItems'));
        
    }

    public function bukticair(Request $request){
        $id             = $request->input('id');
        $pengajuan      = Pengajuan::where('id', $id)->first();
        $bukticairs     = BuktiCair::where('pengajuan_id', $id)->first();
     
        return view('cetak.bukticair-cetak', compact('pengajuan', 'bukticairs'));
    }

    public function laporan(){
        $pengajuans      = Pengajuan::all();
        return view('cetak.laporan-cetak', compact('pengajuans'));
    }
}
