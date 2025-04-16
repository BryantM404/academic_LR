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
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
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

        $newUser = DB::table('user')->where('username', $validatedData['username'])->first();
    
        if (!$newUser) {
            return redirect()->route('userCreate')->with('error', 'Gagal mendapatkan User ID');
        }

        return redirect()->route('userCreateForms', [
            'role' => $validatedData['role_id'],
            'user' => $newUser->id
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::with(['userRole', 'userKaprodi', 'userTataUsaha', 'userMahasiswa'])
            ->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhereHas('userMahasiswa', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('userKaprodi', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('userTataUsaha', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('userRole', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    });
                    
            })
            ->get();
        return view('superadmin.index', compact('users', 'search'));
    }

    public function forms($role, $user)
    {
        $roleData = Role::findOrFail($role);
        $user = User::findOrFail($user);
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
            'password' => ['nullable', 'string', 'max:100'],
            'role_id' => ['required', 'exists:role,id']
        ])->validate();

        if (empty($validatedData['password'])) {
            $finalPassword = $user->password; 
        } elseif (Hash::check($validatedData['password'], $user->password)) {
            $finalPassword = $user->password; 
        } else {
            $finalPassword = Hash::make($validatedData['password']); 
        }
        
        DB::statement("CALL SPEditUser(?, ?, ?)", [
            $id,
            $validatedData['username'],
            $finalPassword
        ]);

        return redirect()->route('userEditForms', [
            'role' => $validatedData['role_id'],
            'user' => $id
        ]);


    }

    public function editForms($role, $user)
    {

        $roleData = Role::findOrFail($role);
        $user = User::findOrFail($user);
        $prodis = Prodi::all(); 
        return view('superadmin.editForms', compact('roleData', 'user', 'prodis'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, string $id)
    {
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
        $roles = Role::with('roleUser')->get();

        return view('layouts.starter')
            ->with('users', User::all())
            ->with('pengajuans', Pengajuan::all())
            ->with('roles', $roles);
    }


}
