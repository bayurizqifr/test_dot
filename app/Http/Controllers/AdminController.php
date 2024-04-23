<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function login_admin(){
        if (session('admin')) {
            return redirect('/admin/dashboard');
        }else{
            return view('admin.login-admin');
        }
    }

    public function home(){
        return view('admin.home');
    }

    public function logout_admin(){
        // session()->flush();
        session()->forget(['admin', 'role']);
        return redirect('/login-admin');
    }

    public function login_admin_cek(Request $request){
        $user = DB::table('users')->where([['name', $request->name], ['password', $request->password]])->first();

        if ($user->role == 'admin' || $user->role == 'super_admin') {
            session([
                'admin' => true,
                'role' => $user->role,
            ]);
            session()->flash('berhasil-masuk', 'Selamat datang '.$request->name);
            return redirect('/admin/dashboard');
        }else{
            session()->flash('gagal-masuk', 'Username / Password salah');
            return redirect('/login-admin');
        }
    }

    public function add_user(){
        $user = DB::table('users')->get();
        $data = [
            'user' => $user
        ];
        return view('admin.add-user', $data);
    }
}
