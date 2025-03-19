<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
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
            $validatedData['password'],
            $validatedData['role_id']
        ]);

        return redirect(route('userList'));
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
}
