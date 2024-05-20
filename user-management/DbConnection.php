<?php

class DbConnection
{
    private $host = "localhost";
    private $dbName = "demo";
    private $username = "demo_user";
    private $password = "conan14121";
    protected $conn;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    public function openConnection()
    {
        $connectionString="mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";

        try {
            $this->conn=new PDO($connectionString,$this->username,$this->password,$this->options);
            return $this->conn;
        }
        catch (PDOException $e){
            echo $e->getMessage();
    }
    }
    public function closeConnection(){
        return $this->conn=null;
    }

}