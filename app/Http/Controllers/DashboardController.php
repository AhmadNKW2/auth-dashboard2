<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the user has an 'admin' role
        if (Auth::user()->hasRole('admin')) {
            return view('admin.dashboard');
        }

        // If the user has other roles or no role
        return view('dashboard');
    }
}
