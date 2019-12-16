<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    //
    public function contact_form()
    {
        return view('cs.contact');
    }

    public function faqs_list()
    {
        return view('cs.faqs');
    }
}
