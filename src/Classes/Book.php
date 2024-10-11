<?php
namespace Youssef\ScandiwebTask\Classes;
use Youssef\ScandiwebTask\Model\Product;

class Book extends Product
{
    private $weight;
    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }
    public function getAttribute()
    {
        return "Weight: {$this->weight} KG";
    }
}