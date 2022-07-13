<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }
    public function contact()
    {
        return view('web.Contacts.index');
    }
}
