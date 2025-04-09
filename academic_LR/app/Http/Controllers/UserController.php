<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Prodi;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        return (view('superadmin.index')
        ->with('users', User::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Ambil semua role
        return view('superadmin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // $request->validate([
        //     'username' => 'required|string|max:255|unique:users,username',
        //     'password' => 'required|string|min:6',
        //     'role_id' => 'required|exists:roles,id' // Pastikan role_id valid
        // ]);

        $validatedData = validator($request->all(),[
            'username' => 'required|string|max:7|unique:user,username',
            'password' => 'required|string|max:100',
            'role_id' => 'required|exists:role,id',
        ])->validate();

        DB::statement("CALL SPInsertUser(?, ?, ?)", [
            $validatedData['username'],
            Hash::make($validatedData['password']),
            $validatedData['role_id']
        ]);

        // ini method untuk mendapatkan user id yang akan dikirim ke page selanjutnya
        $newUser = DB::table('user')->where('username', $validatedData['username'])->first();
    
        if (!$newUser) {
            return redirect()->route('userCreate')->with('error', 'Gagal mendapatkan User ID');
        }

        // return redirect()->route('userCreateForms');
        return redirect()->route('userCreateForms', ['role' => $validatedData['role_id'], 'user' => $newUser->id]);

        // return view('/superadmin/create/forms')
        //     ->with('idRole', $request->input('role_id'));

    }

    public function forms($role, $user)
    {
        // return view('mahasiswa.forms')
        //     ->with('jenisSurat', $request->input('jenisSurat_id'));
        // return view('superadmin.forms')
        //     ->with('idRole', $request->input('role_id'));

        $roleData = Role::find($role);
        $userData = DB::table('user')->where('id', $user)->first();
        
        if (!$roleData) {
            return redirect()->route('userCreate')->with('error', 'Role tidak ditemukan!');
        }

        // Ambil semua prodi
        $prodis = Prodi::all(); 
    
        return view('superadmin.forms', compact('roleData', 'userData', 'prodis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function dashboard()
    {
        return view('layouts.starter')
            ->with('pengajuans', Pengajuan::all());
    }


}
