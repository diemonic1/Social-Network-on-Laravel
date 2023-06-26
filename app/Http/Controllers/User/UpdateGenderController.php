<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateGenderRequest;
use Illuminate\Support\Facades\Auth;

class UpdateGenderController extends Controller
{
    public function __invoke(UpdateGenderRequest $request)
    {
        $user = Auth::user();

        $request->validated();

        $gender = $request->file('gender')->getClientOriginalName();

        $user->update(['gender' => $gender]);

        return redirect()->route('dialogues.index');
    }
}
