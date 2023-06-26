<?php

namespace App\Services\Dialogue;

use App\Models\Dialogue;
use App\Models\Message;
use App\Models\User;
use App\Models\UserDialogue;
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

    public function getCompanion(Dialogue $dialogue)
    {
        $me = $this->getMe();
        $users = $dialogue->users;

        if ($dialogue->users[0]->id == $me->id)
        {
            return $users[1];
        }
        else
        {
            return $users[0];
        }
    }

    public function index(string $keyForSearchDialogue)
    {
        $me = $this->getMe();
        $dialogues = $me->dialogues;

        $myDialogues = [];

        foreach ($dialogues as $dialogue)
        {
            if ($keyForSearchDialogue != '')
            {
                $name_1 = '';
                $name_2 = '';
                if ($dialogue->users[0]->name != $me->name)
                {
                    $name_1 = $dialogue->users[0]->name;
                }
                else
                {
                    $name_2 = $dialogue->users[1]->name;
                }

                $contain_name_1 = str_contains(Str::lower($name_1), Str::lower($keyForSearchDialogue));
                $contain_name_2 = str_contains(Str::lower($name_2), Str::lower($keyForSearchDialogue));
            }
            else
            {
                $contain_name_1 = true;
                $contain_name_2 = true;
            }

            if ($contain_name_1 or $contain_name_2) {
                $messages = $dialogue->messages;

                $countOfUnread = 0;
                foreach ($messages as $message) {
                    if ($message->read_at == Null && $message->user_id != $me->id) {
                        $countOfUnread++;
                    }
                }

                $lastMessage = '';
                $lastMessageUser = '';

                if (count($messages) > 0) {
                    $lastMessage = $dialogue->messages->last();
                    if ($lastMessage->user->id == $me->id) {
                        $lastMessageUser = "Вы";
                    }
                }

                $myDialogues = Arr::add($myDialogues, $dialogue->id, [
                    'dialogue_id' => $dialogue->id,
                    'companionName' => $this->getCompanion($dialogue)->name,
                    'countOfUnread' => $countOfUnread,
                    'companionAvatar' => $this->getCompanion($dialogue)->avatar,
                    'lastMessage' => $lastMessage,
                    'lastMessageUser' => $lastMessageUser,
                ]);
            }
        }

        return $myDialogues;
    }

    public function getUsersWithoutDialogue()
    {
        $me = $this->getMe();

        $usersWithoutDialogue = [];

        $allUsers = User::all();

        foreach ($allUsers as $user)
        {
            $skip = false;
            $hisDialogues = $user->dialogues;
            foreach ($hisDialogues as $dialogue)
            {
                $usersOfThisDialogue = $dialogue->users;
                if ($usersOfThisDialogue[0]->id == $me->id || $usersOfThisDialogue[1]->id == $me->id)
                {
                    $skip = true;
                }
            }
            if (!$skip)
            {
                if ($user !=$me) {
                    array_push($usersWithoutDialogue, $user);
                }
            }
        }

        return $usersWithoutDialogue;
    }

    public function createDialogue($other_user)
    {
        $me = $this->getMe();

        $users = [$other_user, $me];
        $dialogue = Dialogue::create();

        foreach ($users as $user)
        {
            UserDialogue::firstOrCreate([
                'dialogue_id' => $dialogue->id,
                'user_id' => $user->id
            ]);
        }

        return $dialogue;
    }

    public function store($data, $dialogue_id)
    {
        $me = $this->getMe();

        $message = [
            'content' => $data['content'],
            'dialogue_id' => $dialogue_id,
            'user_id' => $me->id,
        ];

        $createdMessage = Message::create($message);

        return $createdMessage;
    }

    public function readAllMessages(Dialogue $dialogue)
    {
        $me = $this->getMe();
        $messages = $dialogue->messages;

        $wasRead = false;

        foreach ($messages as $message)
        {
            if ($message->read_at == Null && $message->user_id != $me->id)
            {
                $message->update(['read_at' => date('Y-m-d H:i:s')]);
                $wasRead = true;
            }
        }

        return $wasRead;
    }

    public function getMessages(Dialogue $dialogue){
        $messages = $dialogue->messages;

        $mass = [];

        foreach ($messages as $message){
            array_push($mass, [
                'user' => $message->user,
                'message' => $message
            ]);
        }

        return $mass;
    }
}
