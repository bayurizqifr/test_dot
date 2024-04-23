<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
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
        return view('admin.add-user-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|max:60',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|max:255',
            'role' => 'required',
        ],[
            'required' => 'Field :attribute tidak boleh kosong',
            'unique' => 'Data sudah terdaftar',
            'email' => 'Format email salah',
            'max' => 'Maksimal :max huruf',
        ]);

        User::create([
            'name' => $request->nama_user,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        session()->flash('status-sukses', 'data berhasil ditambahkan');
        return redirect('/admin/add-user');
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
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        // echo '<pre>';var_dump($user);die;
        $data = [
            'user' => $user
        ];
        return view('admin.add-user-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $request->validate([
            'nama_user' => 'required|max:60',            
            'password' => 'required|max:255',
            'role' => 'required',
        ],[
            'required' => 'Field :attribute tidak boleh kosong',
            'unique' => 'Data sudah terdaftar',
            'email' => 'Format email salah',
            'max' => 'Maksimal :max huruf',
        ]);

        User::where('id', $id)->update([
            'name' => $request->nama_user,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        session()->flash('status-sukses', 'data berhasil diubah');
        return redirect('/admin/add-user/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        User::where('id', $id)->delete();

        session()->flash('status-sukses', 'data berhasil dihapus');
        return redirect('/admin/add-user');
    }
}
