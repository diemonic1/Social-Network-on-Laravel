<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageDelete;
use App\Http\Controllers\Controller;
use App\Models\Message;

class DestroyController extends Controller
{
    public function __invoke(Message $message)
    {
        $dialogue_id = $message->dialogue;
        $message->delete();

        broadcast(new MessageDelete());

        return true;
        //return redirect()->route('dialogues.show', $dialogue_id);
    }
}
