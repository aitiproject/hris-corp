<?php

namespace App\Modules\Home\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    private $data = [
        'meta' => [
            'pageTitle' => 'Home'
        ],
        'breadcrumb' => [
            ['name' => 'Home', 'url' => 'javascript:;'],
            ['name' => 'Home 1', 'url' => 'javascript:;']
        ]
    ];

    public function index()
    {
        return $this->loadView('home', $this->data);
    }
}
