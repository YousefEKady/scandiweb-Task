<?php
namespace Youssef\ScandiwebTask\Classes;
use Youssef\ScandiwebTask\Model\Product;

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }
    public function getAttribute()
    {
        return "Size: {$this->size} MB";
    }
}