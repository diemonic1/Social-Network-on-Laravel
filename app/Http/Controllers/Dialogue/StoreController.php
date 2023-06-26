<?php

namespace App\Http\Controllers\Dialogue;

use App\Events\MessageSent;
use App\Http\Requests\Dialogue\StoreRequest;
use App\Models\Dialogue;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request, Dialogue $dialogue) {
        $data = $request->validated();

        $createdMessage = $this->service->store($data, $dialogue->id);

        broadcast(new MessageSent(auth()->user(), $createdMessage));

        return $createdMessage;
        #return redirect()->route('dialogues.show', $dialogue->id);
    }
}
