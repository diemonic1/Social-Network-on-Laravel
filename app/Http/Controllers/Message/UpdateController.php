<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageEdit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\UpdateRequest;
use App\Models\Message;
use Illuminate\Support\Arr;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Message $message) {
        $dialogue_id = $message->dialogue;

        $data = $request->validated();

        if ($message->content != $data['content'])
        {
            $data = Arr::add($data, 'edit_at', date('Y-m-d H:i:s'));
            $message->update($data);
        }

        broadcast(new MessageEdit());

        return true;
    }
}
