<?php

class Task
{
    //DB info
    private static $conn;
    private static $table = "task";

    //Object properties
    public $id;
    public $name;
    public $description;
    public $deadline;
    
    public function __construct($db)
    {
        self::$conn = $db;
    }

    public function create()
    {
        //Creating new task
        $sql = "INSERT INTO ".self::$table." SET name=:name, description=:description, deadline=:deadline ";
        //Binding some variables for easier connection and smaller possibility of errors
        $query = self::$conn->prepare($sql);
        $query->bindParam(":name", $this->name);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":deadline", $this->deadline);
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }

    public static function index($db)
    {
        //Connecting to database
        self::$conn = $db;
        //Gathering data from DB
        $sql = "SELECT * FROM ".self::$table;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE " . self::$table . " SET 
        name = :name, 
        description = :description, 
        deadline = :deadline 
        WHERE id = :id";
        $query = self::$conn->prepare($sql);
        $query->bindParam(":name", $this->name);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":deadline", $this->deadline);
        $query->bindParam(":id", $this->id);

        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }

        public function getChosen()
    {   
        //Gathering Info about our chosen record
        $sql = "SELECT * FROM " . self::$table . " WHERE id = " . $this->id;
        $query = self::$conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        // assigning values for variables
        $this->name = $result['name'];
        $this->description = $result['description'];
        $this->deadline = $result['deadline'];
    }

    public function delete()
    {
        $sql = "DELETE FROM ". self::$table . " WHERE id = " . $this->id;
        $query = self::$conn->prepare($sql);
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }


}


?>