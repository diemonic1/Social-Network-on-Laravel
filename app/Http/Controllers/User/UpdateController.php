<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $user = Auth::user();

        $keysForValidate = [];

        if(!Hash::check($request->oldPassword, $user->password))
        {
            return back()->withErrors([
                'oldPassword' => ['Вы должны ввести свой старый пароль!']
            ]);
        }
        if ($request->name != $user->name)
        {
            $keysForValidate = Arr::add($keysForValidate, 'name', 'string|max:22');
        }
        if ($request->login != $user->login)
        {
            $keysForValidate = Arr::add($keysForValidate, 'login', 'string|max:255|unique:users,login,');
        }
        if ($request->email != $user->email)
        {
            $keysForValidate = Arr::add($keysForValidate, 'email', 'string|email|max:255|unique:users,email,');
        }
        if ($request->password != '')
        {
            $keysForValidate = Arr::add($keysForValidate, 'password', 'string|min:4|confirmed');
        }

        $data = $request->validate($keysForValidate);

        $user->update($data);

        return redirect()->route('dialogues.index');
    }
}
