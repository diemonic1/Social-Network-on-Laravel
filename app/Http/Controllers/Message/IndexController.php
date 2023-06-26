<?php

namespace App\Http\Controllers\Message;

class IndexController extends BaseController
{
    public function __invoke(string $key)
    {
        $myMessages = $this->service->index($key);

        return view('FoundMessages', compact('myMessages'));
    }
}
