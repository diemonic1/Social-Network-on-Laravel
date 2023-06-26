<?php

namespace App\Http\Controllers\Dialogue;

class getAllDialoguesController extends BaseController
{
    public function __invoke(string $key = '')
    {
        $myDialogues = $this->service->index($key);

        return $myDialogues;
    }
}
