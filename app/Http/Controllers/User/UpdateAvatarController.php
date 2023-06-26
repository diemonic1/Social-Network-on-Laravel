<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateAvatarController extends Controller
{
    public function __invoke(UpdateAvatarRequest $request)
    {
        $user = Auth::user();

        $request->validated();

        $path = $request->file('avatar')->store('uploads','public');

        $oldAvatar = $user->avatar;

        if($oldAvatar != null && $oldAvatar != 'uploads/noneAvatar.png') {
            Storage::disk('public')->delete($oldAvatar);
        }

        $user->update(['avatar' => $path]);

        return redirect()->route('dialogues.index');
    }
}
