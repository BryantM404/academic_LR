<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Prodi;
use App\Models\Pengajuan;
use App\Models\Kaprodi;
use App\Models\TataUsaha;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // return (view('superadmin.index')
        // ->with('users', User::all()));

        $users = User::with(['userRole', 'userKaprodi', 'userTataUsaha', 'userMahasiswa'])->get();
        return view('superadmin.index', compact('users'));
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

        return redirect()->route('userCreateForms', [
            'role' => $validatedData['role_id'],
            'user' => $newUser->id
        ]);
    }

    public function forms($role, $user)
    {

        $roleData = Role::findOrFail($role);
        $user = User::findOrFail($user);

        // Ambil semua prodi
        $prodis = Prodi::all(); 
        return view('superadmin.forms', compact('roleData', 'user', 'prodis'));
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
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'User not found!']);
        }
        return view('superadmin.edit')
            ->with('roles', Role::all())
            ->with('users', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'User not found!']);
        }
        $validatedData = validator($request->all(),[
            'username' => ['required', 'string', 'max:7', Rule::unique('user', 'username')->ignore($user->username, 'username')],
            'password' => ['required', 'string', 'max:100'],
            'role_id' => ['required', 'exists:role,id']
        ])->validate();

        DB::statement("CALL SPEditUser(?, ?, ?)", [
            $id,
            $validatedData['username'],
            Hash::make($validatedData['password']),
        ]);

        // ini method untuk mendapatkan user id yang akan dikirim ke page selanjutnya
    
        return redirect()->route('userEditForms', [
            'role' => $validatedData['role_id'],
            'user' => $id
        ]);
    }

    public function editForms($role, $user)
    {

        $roleData = Role::findOrFail($role);
        $user = User::findOrFail($user);

        // Ambil semua prodi
        $prodis = Prodi::all(); 
        return view('superadmin.editForms', compact('roleData', 'user', 'prodis'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, string $id)
    {

        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->route('userList')->with('success', 'User berhasil dihapus.');
        Kaprodi::where('user_id', $id)->delete();
        TataUsaha::where('user_id', $id)->delete();
        Mahasiswa::where('user_id', $id)->delete();

        $user = User::find($id);
        if ($user == null) {
            return back()->withErrors(['err_msg' => 'user not found!']);
        }

        $user->delete();
        return redirect()->route('userList')
            ->with('status', 'user successfully deleted!');
    }

    public function dashboard()
    {
        return view('layouts.starter')
            ->with('pengajuans', Pengajuan::all());
    }


}
