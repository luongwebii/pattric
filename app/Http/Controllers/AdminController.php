<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function settings()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('welcome');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

}
