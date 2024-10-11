<?php
namespace Youssef\ScandiwebTask\Classes;
use PDO;

abstract class Model
{
    protected $conn;
    protected $table;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=scandiweb", "root", "");
        $this->setTableName();
    }
    public abstract function setTableName();

    // Fetch All
    public function fetchAll()
    {
        $query = "SELECT products.sku, products.name, products.price, products.type,dvd.size, 
            furniture.height, furniture.width, furniture.length, 
            book.weight
        FROM products
        LEFT JOIN dvd ON products.sku = dvd.sku
        LEFT JOIN furniture ON products.sku = furniture.sku
        LEFT JOIN book ON products.sku = book.sku
    ";

        $runQuery = $this->conn->prepare($query);
        $runQuery->execute();
        return $runQuery->fetchAll(PDO::FETCH_ASSOC);
    }

}