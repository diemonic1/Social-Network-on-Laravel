<?php

namespace App\Http\Controllers\Dialogue;

use App\Events\MessageRead;
use App\Models\Dialogue;
use App\Models\Message;

class GetMessagesController extends BaseController
{
    public function __invoke(Dialogue $dialogue, Message $messageToShow = null)
    {
        $wasRead = $this->service->readAllMessages($dialogue);

        $messages = $this->service->getMessages($dialogue);

        if ($wasRead){
            broadcast(new MessageRead());
        }

        return $messages;
    }
}
