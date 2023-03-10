<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * Load view per module with default data format
     */
    protected function loadView(string $name, array $data = [], array $options = [])
    {
        $className  = get_class($this);
        $exp        = explode('Controllers', $className);
        $moduleName = $exp[0];
        $name       = strpos($name, $moduleName) === false ? $moduleName . 'Views\\' . $name . '.php' : $name;

        $defaultData = [
            'isAjax' => $this->request->isAJAX(),
            'meta'   => [
                'appName'     => env('app.name'),
                'pageTitle'   => "Sample Page",
                'description' => "Sample Page of HRIS corporate system",
                'author'      => "@arif1anto",
            ]
        ];
        
        $mergedData = [];
        foreach ($defaultData as $key => $value) {
            if(is_array($value)){
                $mergedData[$key] = array_merge($value, $data[$key] ?? []);
            } else {
                $mergedData[$key] = $value;
            }
        }
        $data = $mergedData + $data;

        // convert items to object type
        $dataObject = [];
        foreach ($data as $key => $value) {
            $dataObject[$key] = is_array($value) ? (Object) $value : $value;
        }

        // dd($dataObject);

        return view($name, $dataObject, $options);
    }
}
