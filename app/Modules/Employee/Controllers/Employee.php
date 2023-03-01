<?php

namespace App\Modules\Employee\Controllers;

use App\Controllers\BaseController;
use App\Modules\Employee\Models\EmployeeModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Employee extends BaseController
{
    private $employeeModel;
    private $data = [
        'meta' => [
            'pageTitle' => 'Employee'
        ],
        'breadcrumb' => [
            ['name' => 'Employee', 'url' => 'javascript:;']
        ]
    ];

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        return $this->loadView('employee', $this->data);
    }

    public function insert()
    {
        $data = $this->request->getPost();

        $employee = new \App\Modules\Employee\Entities\Employee();
        $employee->fill($data);
        
        $this->employeeModel->save($employee);
    }

    public function json($nik)
    {
        echo $nik;
        return $this->employeeModel->find($nik);
    }
}
