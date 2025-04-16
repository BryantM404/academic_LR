<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\PengajuanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengajuanSuratController extends Controller
{
    public function indexMahasiswa()
    {
        return(view('mahasiswa.pengajuan') 
            ->with('filtered', null)
            ->with('pengajuans', Pengajuan::all()));
    }

    public function indexKaprodi()
    {
        $progress = Pengajuan::where('statusPengajuan_id', '1')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'progressTable');

        $accepted = Pengajuan::where('statusPengajuan_id', '2')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'acceptedTable');
        
        $rejected = Pengajuan::where('statusPengajuan_id', '3')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'rejectedTable');

        $finished = Pengajuan::where('statusPengajuan_id', '4')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'finishedTable');


        return(view('kaprodi.pengajuan')
            ->with('filtered', null)
            ->with('pengajuans', Pengajuan::all())
            ->with('progress', $progress)
            ->with('accepted', $accepted)
            ->with('rejected', $rejected)
            ->with('finished', $finished));
    }

    public function indexTU()
    {
        return(view('tataUsaha.pengajuan')
            ->with('filtered', null)
            ->with('pengajuans', Pengajuan::all()));
    }

    public function detail(string $id)
    {   
        $pengajuan = Pengajuan::find($id);
        $pengajuanDetail = DB::table('pengajuanDetail')->where('pengajuan_id', $id)->first();
        $mahasiswa = DB::table('mahasiswa')->where('id', $pengajuan->mahasiswa_nrp)->first();

        if ($pengajuan == null) {
            return back()->withErrors(['err_msg' => 'Pengajuan tidak ditemukan!']);
        }
        return view('mahasiswa.detail')
            ->with('pengajuan', $pengajuan)
            ->with('pengajuans', Pengajuan::all())
            ->with('pengajuanDetail', $pengajuanDetail)
            ->with('mahasiswa', $mahasiswa);
        }
        
    public function detailKaprodi(string $id)
    {   
        $pengajuan = Pengajuan::find($id);
        $pengajuanDetail = DB::table('pengajuanDetail')->where('pengajuan_id', $id)->first();
        $mahasiswa = DB::table('mahasiswa')->where('id', $pengajuan->mahasiswa_nrp)->first();
        
        if ($pengajuan == null) {
            return back()->withErrors(['err_msg' => 'Pengajuan tidak ditemukan!']);
        }
        return view('kaprodi.detail')
        ->with('pengajuan', $pengajuan)
        ->with('pengajuans', Pengajuan::all())
        ->with('pengajuanDetail', $pengajuanDetail)
        ->with('mahasiswa', $mahasiswa);
    }

    public function detailTU(string $id)
    {   
        $pengajuan = Pengajuan::find($id);
        $pengajuanDetail = DB::table('pengajuanDetail')->where('pengajuan_id', $id)->first();
        $mahasiswa = DB::table('mahasiswa')->where('id', $pengajuan->mahasiswa_nrp)->first();
        
        if ($pengajuan == null) {
            return back()->withErrors(['err_msg' => 'Pengajuan tidak ditemukan!']);
        }
        return view('tataUsaha.detail')
        ->with('pengajuan', $pengajuan)
        ->with('pengajuans', Pengajuan::all())
        ->with('pengajuanDetail', $pengajuanDetail)
        ->with('mahasiswa', $mahasiswa);
    }


    public function edit(string $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuanDetail = DB::table('pengajuanDetail')->where('pengajuan_id', $id)->first();
        $mahasiswa = DB::table('mahasiswa')->where('id', $pengajuan->mahasiswa_nrp)->first();

        if ($pengajuan == null) {
            return back()->withErrors(['err_msg' => 'Pengajuan tidak ditemukan!']);
        }
        return view('mahasiswa.edit')
            ->with('pengajuan', $pengajuan)
            ->with('pengajuans', Pengajuan::all())
            ->with('pengajuanDetail', $pengajuanDetail)
            ->with('mahasiswa', $mahasiswa);
    }


    public function update(Request $request, string $id)
    {
      $pengajuan = Pengajuan::find($id);
      $pengajuan_id = $pengajuan->id;

      if ($pengajuan == null) {
        return back()->withErrors(['err_msg' => 'Pengajuan tidak ditemukan!']);
      }

      $validatedData = $request->validate([
        'nrp' => ['required', 'string', 'max:7'],
        'nama' => ['required', 'string', 'max:45'],
        'alamat' => ['max:75'],
        'semester' => ['max:25'],
        'tujuan' => ['max:200'],
        'kodeMK' => ['max:25'],
        'namaMK' => ['max:50'],
        'jenisSurat_id' => ['required', 'exists:jenisSurat,id'],
      ]);

      DB::statement("CALL SPEditPengajuanDetail(?, ?, ?, ?, ?)", [
        $validatedData['semester'],
        $validatedData['tujuan'],
        $validatedData['kodeMK'],
        $validatedData['namaMK'],
        $pengajuan_id,
      ]);

      notify()->success('Pengajuan berhasil diedit', 'Pengajuan Diedit!', 'connect');


      return redirect()->route('pengajuanList')
        ->with('filtered', null)
        ->with('status', 'Pengajuan berhasil diubah!');
    }


    public function store(Request $request)
    {
        $validatedData = validator($request->all(),[
            'nrp' => 'required|string|max:7',
            'nama' => 'required|string|max:45',
            'alamat' => 'max:75',
            'semester' => 'max:25',
            'tujuan' => 'max:200',
            'kodeMK' => 'max:25',
            'namaMK' => 'max:50',
            'jenisSurat_id' => 'required|exists:jenisSurat,id',
        ])->validate();

        DB::statement("CALL SPInsertPengajuan(?, ?, ?, ?, ?, ?)", [
            null,
            null,
            null,
            Auth::user()->userMahasiswa->id,
            1,
            $validatedData['jenisSurat_id'],
        ]);

        $pengajuan_id = DB::table('pengajuan')->where('mahasiswa_nrp', Auth::user()->userMahasiswa->id)->orderBy('id', 'desc')->first();

        DB::statement("CALL SPInsertPengajuanDetail(?, ?, ?, ?, ?)", [
            $validatedData['semester'],
            $validatedData['tujuan'],
            $validatedData['kodeMK'],
            $validatedData['namaMK'],
            $pengajuan_id->id,
        ]);

        notify()->success('Pengajuan berhasil dibuat', 'Pengajuan Dibuat!', 'connect');

        return(view('mahasiswa.pengajuan')
            ->with('filtered', null)
            ->with('pengajuans', Pengajuan::all()));
    }

    public function delete(String $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan_id = $pengajuan->id;
        
        DB::statement("CALL SPDeletePengajuanDetail(?)", [
            $pengajuan_id,
        ]);
        
        $pengajuan->delete();
        
        notify()->success('Pengajuan berhasil dihapus', 'Pengajuan Dihapus!', 'connect');
        
        return redirect()->route('pengajuanList')
            ->with('status', 'Pengajuan berhasil dihapus!');
    }

    public function accepted(String $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan['statusPengajuan_id'] = 2;
        $pengajuan['keterangan'] = null;
        $pengajuan->save();

        notify()->success('Pengajuan berhasil disetujui', 'Pengajuan Disetujui!', 'connect');
        
        return redirect()->route('pengajuanListKaprodi');
    }
    
    public function rejected(String $id, Request $request)
    {
        $validatedData = validator($request->all(),[
            'keterangan' => 'required|string|max:250',
        ])->validate();

        $pengajuan = Pengajuan::find($id);
        $pengajuan['statusPengajuan_id'] = 3;
        $pengajuan['keterangan'] = $validatedData['keterangan'];
        $pengajuan->save();
        
        notify()->success('Pengajuan berhasil ditolak', 'Pengajuan Ditolak!', 'connect');

        return redirect()->route('pengajuanListKaprodi');
    }


    public function responsStore(Request $request, string $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan['statusPengajuan_id'] = 4;

        $validatedData = validator($request->all(),[
            'dokumen' => 'nullable|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string|max:250',
        ])->validate();

        $namaFile = null;

        if ($request->hasFile('dokumen')) {
            $newFileName = 'FILE_' . $id . '_' . time() . '.' . $request->file('dokumen')->getClientOriginalExtension();
            $request->file('dokumen')->storeAs('uploads', $newFileName);
            $namaFile = $newFileName;
            $pengajuan->dokumen = $namaFile;
        }

        if (!$namaFile && empty($validatedData['keterangan'])) {
            return back()->withErrors(['message' => 'Mohon isi dokumen atau keterangan.']);
        }

        if (!empty($validatedData['keterangan'])) {
            $pengajuan->keterangan = $validatedData['keterangan'];
        }
    
        $pengajuan->save();

        return redirect()->route('pengajuanListTU');
    }

    public function filter1()
    {

        $progress = Pengajuan::where('statusPengajuan_id', '1')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'progressTable');

        $accepted = Pengajuan::where('statusPengajuan_id', '2')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'acceptedTable');
        
        $rejected = Pengajuan::where('statusPengajuan_id', '3')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'rejectedTable');

        $finished = Pengajuan::where('statusPengajuan_id', '4')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'finishedTable');


        if(Auth::user()->role_id == 2){
            return(view('kaprodi.pengajuan')
                ->with('filtered', "1")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        } elseif(Auth::user()->role_id == 4){
            return(view('mahasiswa.pengajuan')
                ->with('filtered', "1")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        }
    }

    public function filter2()
    {

        $progress = Pengajuan::where('statusPengajuan_id', '1')
        ->orderBy('tanggalPengajuan', 'asc')
        ->paginate(5, ['*'], 'progressTable');

        $accepted = Pengajuan::where('statusPengajuan_id', '2')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'acceptedTable');
        
        $rejected = Pengajuan::where('statusPengajuan_id', '3')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'rejectedTable');

        $finished = Pengajuan::where('statusPengajuan_id', '4')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'finishedTable');

        if(Auth::user()->role_id == 2){
            return(view('kaprodi.pengajuan')
                ->with('filtered', "2")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        } elseif(Auth::user()->role_id == 4){
            return(view('mahasiswa.pengajuan')
                ->with('filtered', "2")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        }
    }
    public function filter3()
    {

        $progress = Pengajuan::where('statusPengajuan_id', '1')
        ->orderBy('tanggalPengajuan', 'asc')
        ->paginate(5, ['*'], 'progressTable');

        $accepted = Pengajuan::where('statusPengajuan_id', '2')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'acceptedTable');
        
        $rejected = Pengajuan::where('statusPengajuan_id', '3')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'rejectedTable');

        $finished = Pengajuan::where('statusPengajuan_id', '4')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'finishedTable');

        if(Auth::user()->role_id == 2){
            return(view('kaprodi.pengajuan')
                ->with('filtered', "3")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        } elseif(Auth::user()->role_id == 4){
            return(view('mahasiswa.pengajuan')
                ->with('filtered', "3")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        }
    }
    public function filter4()
    {

        $progress = Pengajuan::where('statusPengajuan_id', '1')
        ->orderBy('tanggalPengajuan', 'asc')
        ->paginate(5, ['*'], 'progressTable');

        $accepted = Pengajuan::where('statusPengajuan_id', '2')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'acceptedTable');
        
        $rejected = Pengajuan::where('statusPengajuan_id', '3')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'rejectedTable');

        $finished = Pengajuan::where('statusPengajuan_id', '4')
            ->orderBy('tanggalPengajuan', 'asc')
            ->paginate(5, ['*'], 'finishedTable');

        if(Auth::user()->role_id == 2){
            return(view('kaprodi.pengajuan')
                ->with('filtered', "4")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        } elseif(Auth::user()->role_id == 4){
            return(view('mahasiswa.pengajuan')
                ->with('filtered', "4")
                ->with('progress', $progress)
                ->with('accepted', $accepted)
                ->with('rejected', $rejected)
                ->with('finished', $finished)
                ->with('pengajuans', Pengajuan::all()));
        }
    }


}