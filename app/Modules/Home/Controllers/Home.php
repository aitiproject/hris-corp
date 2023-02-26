<?php

namespace App\Modules\Home\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return $this->loadView('home');
    }

    public function test()
    {
        return json_encode($_SERVER);
    }
}
