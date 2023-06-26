<?php

namespace App\Services\Message;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Service
{
    public function getMe()
    {
        if (Auth::check()) {
            return Auth::user();
        }
    }

    public function index(string $key)
    {
        $me = $this->getMe();
        $dialogues = $me->dialogues;

        $myMessages = [];

        foreach ($dialogues as $dialogue)
        {
            $messages = $dialogue->messages;

            foreach ($messages as $message) {
                if (str_contains(Str::lower($message->content), Str::lower($key))) {
                    $myMessages = Arr::add($myMessages, $message->id, $message);
                }
            }
        }

        return $myMessages;
    }
}
