<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class IndexController extends Controller
{
    public function index() {
        return view('Index');
    }
}
