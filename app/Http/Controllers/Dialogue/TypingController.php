<?php

namespace App\Http\Controllers\Dialogue;

use App\Events\TypingMessage;

class TypingController extends BaseController
{
    public function __invoke()
    {
        broadcast(new TypingMessage(auth()->user()));

        return auth()->user();
    }
}
