<?php

namespace App\Http\Controllers\Message;
use App\Services\Message\Service;

class BaseController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
