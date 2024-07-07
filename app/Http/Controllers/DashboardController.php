<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('superadmin')){
            return view('superadmin.dashboard');
        // } elseif (Auth::user()->hasRole('rekam_medic')){
        //     return view('rekammedic.dashboard');
        // }elseif(Auth::user()->hasRole('kasir')){
        //     return view('kasir.dashboard');
        // }elseif(Auth::user()->hasRole('gudang') || Auth::user()->hasRole('helper_gudang') || Auth::user()->hasRole('role_kasir')){
        //     return view('gudang.dashboard');
        }else{
            return view('user.dashboard');
        }
    }
}
