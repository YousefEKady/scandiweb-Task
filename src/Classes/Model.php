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
        $runQuery = $this->conn->query("SELECT * FROM $this->table");
        return $runQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}