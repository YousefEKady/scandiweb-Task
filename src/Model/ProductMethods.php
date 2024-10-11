<?php
namespace Youssef\ScandiwebTask\Model;

use Youssef\ScandiwebTask\Classes\Model;

class ProductMethods extends Model
{
    public function fetchAll()
    {
        $this->setTableName();
        return parent::fetchAll(); // Call the parent fetchAll method
    }

    public function setTableName()
    {
        $this->table = "products";
    }
    public function isSkuUnique($sku)
    {
        $runQuery = $this->conn->prepare("SELECT COUNT(*) FROM $this->table WHERE sku = :sku");
        $runQuery->bindParam(':sku', $sku);
        $runQuery->execute();
        $count = $runQuery->fetchColumn();
        return $count === 0;
    }

    public function createProduct($sku, $name, $price, $type, $size, $weight, $height, $width, $length)
    {
        $runQuery = $this->conn->prepare("INSERT INTO $this->table (sku, name, price, type, size, weight, height, width, length) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)");
        $runQuery->bindParam(':sku', $sku);
        $runQuery->bindParam(':name', $name);
        $runQuery->bindParam(":price", $price);
        $runQuery->bindParam(":type", $type);
        $runQuery->bindParam(":size", $size);
        $runQuery->bindParam(":weight", $weight);
        $runQuery->bindParam(":height", $height);
        $runQuery->bindParam(":width", $width);
        $runQuery->bindParam(":length", $length);
        return $runQuery->execute();
    }

    public function deleteProduct($sku)
    {
        $runQuery = $this->conn->prepare("DELETE FROM $this->table WHERE sku = :sku");
        $runQuery->bindParam(":sku", $sku);
        return $runQuery->execute();
    }
}