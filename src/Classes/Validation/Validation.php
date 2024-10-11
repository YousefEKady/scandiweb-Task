<?php
namespace Youssef\ScandiwebTask\Classes\Validation;
require_once 'Required.php';
require_once 'Str.php';

class Validation
{
    private $errors = [];
    public function endValidate($inputName, $value, $rules)
    {
        foreach ($rules as $rule) {
            $rule = "Youssef\ScandiwebTask\Classes\Validation\\" . $rule;
            $obj = new $rule;
            $result = $obj->check($inputName, $value);
            if ($result != false) {
                $this->errors[] = $result;
            }
        }
    }
    public function getError()
    {
        return $this->errors;
    }
}