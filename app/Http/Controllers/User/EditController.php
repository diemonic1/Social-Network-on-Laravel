<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        return view('EditUser', compact('user'));
    }
}
