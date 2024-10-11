<?php
namespace Youssef\ScandiwebTask\Classes\Validation;
use Youssef\ScandiwebTask\Classes\Validation\Validate;
require_once 'Validate.php';

class Required implements Validate
{
    public function check($inputName, $value)
    {
        if (empty($value)) {
            return "Please, submit required data";
        } else {
            return false;
        }
    }
}