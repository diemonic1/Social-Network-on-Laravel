<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;

class EditController extends Controller
{
    public function __invoke(Message $message)
    {
        return view('EditMessage', compact('message'));
    }
}
