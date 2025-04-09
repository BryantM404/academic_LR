<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Kaprodi;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'nama' => 'required|string|max:45',
            'email' => 'required|string|max:45',
            'alamat' => 'required|string|max:75',
            'noTelp' => 'required|string|max:20',
            'tanggalLahir' => 'required|date|max:45',
            'prodi_id' => 'required|exists:prodi,id',
            'user_id' => 'required|exists:user,id',
        ])->validate();

        DB::statement("CALL SPInsertKaprodi(?, ?, ?, ?, ?, ?, ?)", [
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
            'nama' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:75'],
            'noTelp' => ['required', 'string', 'max:20'],
            'tanggalLahir' => ['required', 'date', 'max:45'],
            'prodi_id' => ['required', 'exists:prodi,id'],
            'user_id' => ['required', 'exists:user,id']
        ])->validate();

        DB::statement("CALL SPEditKaprodi(?, ?, ?, ?, ?, ?, ?)", [
            $user,
            $validatedData['nama'],
            $validatedData['email'],
            $validatedData['alamat'],
            $validatedData['noTelp'],
            $validatedData['tanggalLahir'],
            $validatedData['prodi_id'],
        ]);

        return redirect()->route('userList');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kaprodi $kaprodi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kaprodi $kaprodi)
    {
        //
    }
}
