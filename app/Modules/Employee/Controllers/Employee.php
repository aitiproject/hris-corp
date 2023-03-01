<?php

namespace App\Modules\Employee\Controllers;

use App\Controllers\BaseController;

class Employee extends BaseController
{
    private $data = [
        'meta' => [
            'pageTitle' => 'Employee'
        ],
        'breadcrumb' => [
            ['name' => 'Employee', 'url' => 'javascript:;']
        ]
    ];

    public function index()
    {
        return $this->loadView('employee', $this->data);
    }
}
