<?php

namespace App\Http\Controllers\Dialogue;

use App\Events\MessageRead;
use App\Models\Dialogue;
use App\Models\Message;

class ShowController extends BaseController
{
    public function __invoke(Dialogue $dialogue, Message $messageToShow = null)
    {
        $companion = $this->service->getCompanion($dialogue);

        $wasRead = $this->service->readAllMessages($dialogue);
        $myDialogues = $this->service->index('');

        if ($wasRead){
            broadcast(new MessageRead());
        }

        return view('AllDialogues', compact('companion', 'myDialogues', 'dialogue', 'messageToShow'));
    }
}
