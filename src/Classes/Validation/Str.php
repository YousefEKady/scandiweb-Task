<?php
namespace Youssef\ScandiwebTask\Classes\Validation;
use Youssef\ScandiwebTask\Classes\Validation\Validate;

class Str implements Validate
{
    public function Check($inputName, $value)
    {
        if (is_numeric($value)) {
            return "Please, provide the data of indicated type";
        } else {
            return false;
        }
    }
}