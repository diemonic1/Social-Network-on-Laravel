<?php

namespace App\Http\Controllers\Dialogue;

use App\Models\User;

class CreateController extends BaseController
{
    public function __invoke(User $user)
    {
        $dialogue_id = $this->service->createDialogue($user);

        return redirect()->route('dialogues.show', $dialogue_id);
    }
}
