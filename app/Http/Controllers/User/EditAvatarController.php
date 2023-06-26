<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class EditAvatarController extends Controller
{
    public function __invoke()
    {
        return view('EditAvatarUser');
    }
}
