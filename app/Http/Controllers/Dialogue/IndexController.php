<?php

namespace App\Http\Controllers\Dialogue;

class IndexController extends BaseController
{
    public function __invoke(string $key = '')
    {
        $myDialogues = $this->service->index($key);
        $usersWithoutDialogue = $this->service->getUsersWithoutDialogue();

        return view('allDialogues', compact('myDialogues', 'usersWithoutDialogue'));
    }

    /*

        public function Restore() {
            $message = Message::withTrashed()->find(1);

            $message->restore();
        }

        public function FirstOrCreate() {
            $anotherMessage = [
                'content' => 'другой арпа',
            ];

            $message = Message::firstOrCreate([
                'name' => 'Дима',
            ],
            $anotherMessage);
        }

        public function UpdateOrCreate() {
            $anotherMessage = [
                'content' => 'другой арпа',
            ];

            $message = Message::updateOrCreate([
                'name' => 'Дима',
            ],
            $anotherMessage);
        }
        */
}
