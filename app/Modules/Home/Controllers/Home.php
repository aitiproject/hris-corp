<?php

namespace App\Modules\Home\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'meta' => [
                'appName' => 'dadhkad kadhada'
            ]
        ];
        return $this->loadView('home', $data);
    }

    public function test()
    {
        return json_encode($_SERVER);
    }
}
