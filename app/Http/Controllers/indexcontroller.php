<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexcontroller extends Controller
{
    //
    public function index()
    {
       
    return view('Layout.index');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }

}
