<?php
$title = "Task Create";
require "../layout/header.php";

require_once "../config/Database.php";
require "../app/Controller/Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);

if($_POST){
    $task->name = $_POST['name'];
    $task->description = $_POST['description'];
    $task->deadline = $_POST['deadline'];

    if($task->create()){
        header("Location: ../"); 
        
    } else {
        echo "<div class=".'"alert alert-dismissible alert-danger"'.">
        <button type=".'"button"'." class=".'"btn-close"'." data-bs-dismiss=".'"alert"'."></button>
        <strong>Oh snap! Change a few things up and try submitting again.</strong>
      </div>";
    }

}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group container">
    <label class="form-label mt-4">Task Create</label>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Name">
        <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="description" id="floatingPassword" placeholder="Description">
        <label for="floatingPassword">Description</label>
    </div>
    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" name="deadline" id="floatingPassword" placeholder="Deadline">
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