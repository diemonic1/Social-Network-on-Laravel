<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\SearchByMessageRequest;

class SearchByMessageController extends Controller
{
    public function __invoke(SearchByMessageRequest $request)
    {
        $data = $request->validated();

        $key = $data['message'];

        return redirect()->route('message.showSearchResults', $key);
    }
}
