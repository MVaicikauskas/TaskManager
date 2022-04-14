<?php
//Checking if we getting id value with GET method
$id = isset($_GET['id']) ? $_GET['id'] : die("Invalid parameter");

$title = "Update";
require "../layout/header.php";
//Connecting to database's file + class file
require_once "../config/Database.php";
require "../app/Controller/Task.php";
//Connecting to DB
$database = new Database;
$db = $database->getConnection();
//Creating new object and right away stating to use method
$task = new Task($db);
$task->id = $id;
$task->getChosen();

if($_POST){
    $task->name = $_POST['name'];
    $task->description = $_POST['description'];
    $task->deadline = $_POST['deadline'];

    if($task->update()){
        echo "<div class=".'"alert alert-dismissible alert-success"'.">
            <button type=".'"button"'." class=".'"btn-close"'." data-bs-dismiss=".'"alert"'."></button>
            <strong>Well done!</strong> You successfully updated this task.
            </div>";
    } else {
        echo "<div class=".'"alert alert-dismissible alert-danger"'.">
        <button type=".'"button"'." class=".'"btn-close"'." data-bs-dismiss=".'"alert"'."></button>
        <strong>Oh snap!</strong> Something went wrong!.
      </div>";
    }
}

?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?id={$id}"); ?>" method="post">
    <div class="form-group container">
    <label class="form-label mt-4">Task Update</label>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name" value="<?php echo $task->name?>">
        <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="description" id="floatingPassword" placeholder="Description" value="<?php echo $task->description?>">
        <label for="floatingPassword">Description</label>
    </div>
    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" name="deadline" id="floatingPassword" placeholder="Deadline" value="<?php echo $task->deadline?>">
        <label for="floatingPassword">Deadline</label>
    </div>
    </div>
    <div class=" d-flex justify-content-center " role="group" aria-label="Basic example">
    <input type="submit" class="btn btn-success">
    </div>
</form>
<?php
require "../layout/footer.php";
?>