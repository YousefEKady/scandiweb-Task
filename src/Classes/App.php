<?php
namespace Youssef\ScandiwebTask\Classes;

class App
{
    private $url;
    private $controller;
    private $method;
    private $params = [];

    public function __construct($request)
    {
        $this->url = $this->parseUrl($request);
        $this->sprintUrl();
        $this->callMethod();
    }

    // Parse the query string into an array
    private function parseUrl($request)
    {
        $url = trim($request->queryString(), '/');
        return $url ? explode('/', $url) : [];
    }

    // Set controller, method, and parameters
    private function sprintUrl()
    {
        // Default controller is ProductController
        $this->controller = isset($this->url[0]) && $this->url[0] !== '' ? ucfirst($this->url[0]) . "Controller" : "ProductController";

        // Default method is index
        $this->method = isset($this->url[1]) && $this->url[1] !== '' ? $this->url[1] : 'index';

        // Parameters after the method
        $this->params = array_slice($this->url, 2);
    }

    // Call the determined method with optional parameters
    public function callMethod()
    {
        $this->controller = "Youssef\\ScandiwebTask\\Controller\\" . $this->controller;

        if (class_exists($this->controller)) {
            $controllerObj = new $this->controller;

            if (method_exists($controllerObj, $this->method)) {
                // Pass any parameters to the method
                call_user_func_array([$controllerObj, $this->method], $this->params);
            } else {
                die("Method '{$this->method}' Not Found");
            }
        } else {
            die("Class '{$this->controller}' Not Found");
        }
    }
}