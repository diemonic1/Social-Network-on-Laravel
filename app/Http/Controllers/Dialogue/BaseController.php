<?php

namespace App\Http\Controllers\Dialogue;
use App\Services\Dialogue\Service;

class BaseController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
