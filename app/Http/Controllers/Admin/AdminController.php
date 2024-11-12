<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Ensure only admins can access
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
