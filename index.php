<?php
session_start();

$title = "Home";
require "layout/header.php";

require_once "config/Database.php";
require "app/Controller/Task.php";

$database = new Database;
$db = $database->getConnection();

$tasks = Task::index($db);

?>
<?php


if(isset($_SESSION['done'])) {
    if($_SESSION['done'] = 1) {
        $err = "<div class=".'"alert alert-dismissible alert-success"'.">
        <button type=".'"button"'." class=".'"btn-close"'." data-bs-dismiss=".'"alert"'."></button>
        <strong>Well done!</strong> You successfully deleted task.
        </div>";
        echo $err;
        $_SESSION['done'] = null;
    } else {
        $err = "<div class=".'"alert alert-dismissible alert-danger"'.">
        <button type=".'"button"'." class=".'"btn-close"'." data-bs-dismiss=".'"alert"'."></button>
        <strong>Oh snap!</strong> Something went wrong!.
        </div>";
        echo $err;

        $_SESSION['done'] = null;


    }


} 
?>
<table class="table table-hover mt-5 container">
  <thead>
    <tr>
        <th scope="col">Task ID</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Deadline</th>
        <th scope="col">Created</th>
        <th scope="col">Modified</th>
        <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
        foreach($tasks as $task){
            echo "<tr class=".'"table-dark"'.">
            <td scope=".'"row"'.">".$task['id']."</td>
            <td>".$task['name']."</td>
            <td>".$task['description']."</td>
            <td>".$task['deadline']."</td>
            <td>".$task['created']."</td>
            <td>".$task['modified']."</td>
            <td><a class='btn btn-warning' href='views/task.edit.php/?id=".$task['id']."'>Update</a></td>
            <td><a class='btn btn-danger' href='app/Controller/Task.delete.php/?id=".$task['id']."'>Delete</a></td></tr>";
        }
    ?>
  </tbody>
</table>



<?php
require "layout/footer.php";
?>