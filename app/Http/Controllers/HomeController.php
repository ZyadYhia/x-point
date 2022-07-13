<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }
    public function contact()
    {
        $data['contact'] = Contact::first();
        return view('web.Contacts.index')->with($data);
    }
}
