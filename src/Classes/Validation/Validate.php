<?php
namespace Youssef\ScandiwebTask\Classes\Validation;

interface Validate
{
    public function check($inputName, $value);
}