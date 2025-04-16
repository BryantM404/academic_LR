<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TataUsaha;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TataUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexTU()
    {
        
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

        Log::info('📥 Menerima request untuk insert Tata Usaha:', $request->all());

        $validatedData = validator($request->all(),[
            'nama' => 'required|string|max:45',
            'prodi_id' => 'required|exists:prodi,id',
            'user_id' => 'required|exists:user,id',
        ])->validate();

        Log::info('📥 Validasi data berhasil:', $validatedData);

        DB::statement("CALL SPInsertTataUsaha(?, ?, ?)", [
            $validatedData['nama'],
            $validatedData['prodi_id'],
            $validatedData['user_id']
        ]);

        Log::info('📥 Data Tata Usaha berhasil disimpan:', $validatedData);

        return redirect()->route('userList');
    }

    public function updateStore(Request $request, $user)
    {
        $validatedData = validator($request->all(),[
            'nama' => ['required','string','max:45'],
            'prodi_id' => ['required', 'exists:prodi,id'],
            'user_id' => ['required', 'exists:user,id']
        ])->validate();

        DB::statement("CALL SPEditTataUsaha(?, ?)", [
            $user,
            $validatedData['nama']
        ]);

        return redirect()->route('userList');

    }

    /**
     * Display the specified resource.
     */
    public function show(TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TataUsaha $tataUsaha)
    {
        //
    }
}
