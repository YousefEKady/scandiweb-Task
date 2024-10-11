<?php
namespace Youssef\ScandiwebTask\Classes;
use Youssef\ScandiwebTask\Model\Product;

class Furniture extends Product
{
    private $height, $width, $length;
    public function __construct($sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }
    public function getAttribute()
    {
        return "Dimensions: {$this->height}x{$this->width}x{$this->length}";
    }
}