<?php

session_start();
$_SESSION['done'] = null;

$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: no User ID");
require "../../layout/header.php";
require_once "../../config/Database.php";
require "Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);
$task->id = $id;

if($task->delete()){
    $_SESSION['done'] = 1;
    header("Location: ../../../");
} else {
    $_SESSION['done'] = 0;
    header("Location: ../../../");
}


?>
<?php
require "../../layout/footer.php";
?>