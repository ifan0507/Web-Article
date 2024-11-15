<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected static ?string $password;

    public function index()
    {
        $data = [
            'title' => 'Users',
            'user' => User::where('delete_at', '0')->latest()->paginate(10)
        ];
        return view('admin.users.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create User'
        ];
        return view('admin.users.create_user', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);


        Session::flash('status', 'Ditambahkan');
        return redirect()->route('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data  = [
            'title' => 'Edit User',
            'user' => $user
        ];
        return view('admin.users.edit_user', compact('user'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|max:255|unique:users,name,{$id}",
            'email' => "required|string|email|max:255|unique:users,email,{$id}",
            'username' => "required|unique:users,username,{$id}",
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        User::where('id', $id)->update($data);
        Session::flash('status', 'Diperbarui');
        return redirect()->route('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->update(['delete_at' => '1']);
        Session::flash('status', 'Dihapus');
        return redirect()->route('user');
    }
}
