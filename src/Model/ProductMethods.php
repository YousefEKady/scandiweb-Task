<?php
namespace Youssef\ScandiwebTask\Model;

use Youssef\ScandiwebTask\Classes\Model;

class ProductMethods extends Model
{
    public function fetchAll()
    {
        $this->setTableName();
        return parent::fetchAll();
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

    // Insert into Product Table
    public function createProduct($sku, $name, $price, $type, $size = null, $height = null, $width = null, $length = null, $weight = null)
    {
        $runQuery = $this->conn->prepare("INSERT INTO $this->table (sku, name, price, type) VALUES (:sku, :name, :price, :type)");
        $runQuery->bindParam(':sku', $sku);
        $runQuery->bindParam(':name', $name);
        $runQuery->bindParam(":price", $price);
        $runQuery->bindParam(":type", $type);
        if ($runQuery->execute()) {
            return $this->specificType($sku, $type, $size, $height, $width, $length, $weight);
        }
        return false;
    }

    // Insert into specific type table
    public function specificType($sku, $type, $size = null, $height = null, $width = null, $length = null, $weight = null)
    {
        switch ($type) {
            case 'DVD':
                $query = "INSERT INTO dvd (sku, size) VALUES (:sku, :size)";
                $runQuery = $this->conn->prepare($query);
                $runQuery->bindParam(':sku', $sku);
                $runQuery->bindParam(':size', $size);
                break;

            case 'Furniture':
                $query = "INSERT INTO furniture (sku, height, width, length) VALUES (:sku, :height, :width, :length)";
                $runQuery = $this->conn->prepare($query);
                $runQuery->bindParam(':sku', $sku);
                $runQuery->bindParam(':height', $height);
                $runQuery->bindParam(':width', $width);
                $runQuery->bindParam(':length', $length);
                break;

            case 'Book':
                $query = "INSERT INTO book (sku, weight) VALUES (:sku, :weight)";
                $runQuery = $this->conn->prepare($query);
                $runQuery->bindParam(':sku', $sku);
                $runQuery->bindParam(':weight', $weight);
                break;

            default:
                return false;
        }
        return $runQuery->execute();
    }

    public function deleteProduct($sku)
    {
        $runQuery = $this->conn->prepare("DELETE FROM $this->table WHERE sku = :sku");
        $runQuery->bindParam(":sku", $sku);
        return $runQuery->execute();
    }
}