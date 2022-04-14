<?php

class Database
{
    //Data required for Connection to DB
    private $host = "localhost";
    private $dbName = "Tasks";
    private $username = "root";
    private $password = "";
    public $conn;

    //Connecting to DB...
    public function getConnection()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->username, $this->password);
            // echo "connected123";
        } catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
        return $this->conn;
    }

}



?>