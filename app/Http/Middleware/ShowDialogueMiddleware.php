<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShowDialogueMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dialogue = $request->route('dialogue');

        if (Auth::user()->id != $dialogue->users[0]->id && Auth::user()->id != $dialogue->users[1]->id) {
            return redirect()->route('dialogues.index');
        }
        return $next($request);
    }
}
