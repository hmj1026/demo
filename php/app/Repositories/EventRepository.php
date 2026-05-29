<?php

namespace App\Repositories;

use App\Repositories\BaseMethod;
use App\Models\Event;

class EventRepository
{
    use BaseMethod;

    private $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

}