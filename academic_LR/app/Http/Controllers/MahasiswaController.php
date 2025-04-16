<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return(view('mahasiswa.index'));
    }

    public function form()
    {
        return(view('mahasiswa.form'))
            ->with('jenisSurats', JenisSurat::all())
            ->with('pengajuans', Pengajuan::all());
    }

    public function forms(Request $request)
    {
        return view('mahasiswa.forms')
            ->with('pengajuans', Pengajuan::all())
            ->with('jenisSurat', $request->input('jenisSurat_id'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $user)
    {
        $validatedData = validator($request->all(),[
            'nrp' => 'required|string|max:7|unique:mahasiswa,nrp',
            'nama' => 'required|string|max:45',
            'email' => 'required|string|max:45',
            'alamat' => 'required|string|max:75',
            'noTelp' => 'required|string|max:20',
            'tanggalLahir' => 'required|date',
            'prodi_id' => 'required|exists:prodi,id',
            'user_id' => 'required|exists:user,id',
        ])->validate();

        DB::statement("CALL SPInsertMahasiswa(?, ?, ?, ?, ?, ?, ?, ?)", [
            $validatedData['nrp'],
            $validatedData['nama'],
            $validatedData['email'],
            $validatedData['alamat'],
            $validatedData['noTelp'],
            $validatedData['tanggalLahir'],
            $validatedData['prodi_id'],
            $validatedData['user_id']
        ]);
        

        return redirect()->route('userList');
    }

    public function updateStore(Request $request, $user)
    {
        $validatedData = validator($request->all(),[
            'nrp' => ['required','string','max:7'],
            'nama' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:75'],
            'noTelp' => ['required', 'string', 'max:20'],
            'tanggalLahir' => ['required', 'date', 'max:45'],
            'prodi_id' => ['required', 'exists:prodi,id'],
            'user_id' => ['required', 'exists:user,id']
        ])->validate();

        DB::statement("CALL SPEditMahasiswa(?, ?, ?, ?, ?, ?, ?, ?)", [
            $user,
            $validatedData['nrp'],
            $validatedData['nama'],
            $validatedData['email'],
            $validatedData['alamat'],
            $validatedData['noTelp'],
            $validatedData['tanggalLahir'],
            $validatedData['prodi_id']
        ]);
        return redirect()->route('userList');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
