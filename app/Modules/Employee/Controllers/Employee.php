<?php

namespace App\Modules\Employee\Controllers;

use App\Controllers\BaseController;
use App\Modules\Employee\Entities\Employee as EntitiesEmployee;
use App\Modules\Employee\Models\EmployeeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Employee extends BaseController
{
    use ResponseTrait;
    private $empModel;
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

        $this->empModel = new EmployeeModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            // $start = $this->request->getGet('start');
            // $length = $this->request->getGet('length');
            $data = [
                'data' => $this->empModel->findAll(),
                // 'recordsTotal'    => $this->empModel->countAll(),
                // 'recordsFiltered' => $this->empModel->countAll(),
                // 'draw'            => $this->request->getGet('draw'),
            ];
            return $this->respond($data, 200);
        }
        $fields = [];
        foreach ($this->empModel->allowedFields as $key => $value) {
            $fields[$key]['data'] = $value;
            $fields[$key]['title'] = ucwords(str_replace('_', ' ', $value));
        }
        $this->data['fields'] = $fields;
        return $this->loadView('employee', $this->data);
    }

    public function new()
    {
    }

    public function edit()
    {
    }

    // get single employee
    public function show($id = null)
    {
        $data = $this->empModel->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    // create a employee
    public function create()
    {
        $emp = new EntitiesEmployee();
        $emp->fill($this->request->getPost());
        $this->empModel->save($emp);
        $response = [
            'status'   => 201,
            'error'    => null,
            'data'     => $emp,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($response, 201);
    }

    // update employee
    public function update($id = null)
    {
        $emp = $this->empModel->find($id);
        $emp->fill($this->request->getPost());
        $emp->nik = $id;
        $this->empModel->save($emp);
        $response = [
            'status'   => 200,
            'error'    => null,
            'data'     => $emp,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function batch_update()
    {
        $post = $this->request->getPost('data');
        // print_r($post); die;
        foreach ($post as $id => $val) {
            $emp = $this->empModel->find($id);
            $emp->fill($val);
            $emp->nik = $id;
            $this->empModel->save($emp);
        }
        $response = [
            'status'   => 200,
            'error'    => null,
            'data'     => $post,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete employee
    public function delete($id = null)
    {
        $data = $this->empModel->find($id);
        if ($data) {
            $this->empModel->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
