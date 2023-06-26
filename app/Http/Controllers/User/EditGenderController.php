<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class EditGenderController extends Controller
{
    public function __invoke()
    {
        return view('EditGenderUser');
    }
}
