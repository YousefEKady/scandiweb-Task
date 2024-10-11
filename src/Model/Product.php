<?php
namespace Youssef\ScandiwebTask\Model;
use Youssef\ScandiwebTask\Classes\Model;

abstract class Product extends Model
{
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }
    public function setTableName()
    {
        $this->table = "products";
    }

    abstract public function getAttribute();

}