<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SuratKeluar;
class SuratKeluarController extends Controller
{
    public function index()
    {
        return SuratKeluar::latest()->paginate(20); 
    }

    public function store(Request $request)
    {
        $this -> validate($request,[
            'no_surat' => 'required|string|max:20',
            'nama_kegiatan' => 'required|string|max:20',
            'perihal_surat' => 'required|string|max:100',
            'tanggal_surat_keluar' => 'required|string',
            'tujuan' => 'required|string|max:20',

        ]);
        return SuratKeluar::create([
            'no_surat' => $request['no_surat'],
            'nama_kegiatan' => $request['nama_kegiatan'],
            'perihal_surat' => $request['perihal_surat'],
            'tanggal_surat_keluar' => $request['tanggal_surat_keluar'],
            'tujuan' => $request['tujuan'],
        ]); 
    }

    public function update(Request $request, $id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $this -> validate($request,[
            'no_surat' => 'required|string|max:20',
            'nama_kegiatan' => 'required|string|max:20',
            'perihal_surat' => 'required|string|max:100',
            'tanggal_surat_keluar' => 'required|string',
            'tujuan' => 'required|string|max:20',
            
        ]);
        

        $suratkeluar->update($request->all());
        return ['message' => 'updated data'];
    }

    public function destroy($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $suratkeluar->delete();
        return ['message' => 'Data deleted successfully'];
    }


    public function search(){
        if ($search = \Request::get('q')) {
            $suratkeluars = SuratKeluar::where(function($query) use ($search){
                $query->where('no_surat','LIKE',"%$search%")
                ->orWhere('tujuan','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $suratkeluars = SuratKeluar::latest()->paginate(8);
        }

        return $suratkeluars;

    }
}
