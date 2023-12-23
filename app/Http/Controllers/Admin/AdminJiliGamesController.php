<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JiliManagements;
use Illuminate\Http\Request;

class AdminJiliGamesController extends Controller
{
    //AdminJiliSettings
    public function AdminJiliSettings()
    {
        $dataType = JiliManagements::find(1);
        return view('admin.pages.jili.settings')->with(compact('dataType'));
    }

    //AdminJiliHistory
    public function AdminJiliHistory()
    {
        return view('admin.pages.jili.history');
    }
}
