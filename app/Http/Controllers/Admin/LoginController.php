<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
     {
         return view('Pengguna.login');
     }

     public function login(Request $request)
     {
         $request->validate([
            
             'email' => 'email',
             'password' => 'required'
         ], [
             
             'email.required' => 'Email wajib diisi',
             'password.required' => 'Password wajib diisi',
         ]);

         $infologin = [
             'email' => $request->email,
             'password' => $request->password
         ];

         if(Auth::attempt($infologin)){
             return redirect('/Admin/Dashboard');
             exit();
         } else {
             return redirect('/')->withErrors('Username dan Password yang dimasukan tidak sesuia')->withInput();
         }
     }
     // <!-- /Sesi Login -->

     function logout()
     {
         Auth::logout();
         return redirect('/');
     }
}
