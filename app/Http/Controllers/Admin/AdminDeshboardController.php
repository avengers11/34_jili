<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDeshboardController extends Controller
{
    //AdminIndex
    public function AdminIndex()
    {
        return view('admin.pages.index');
    }
}
