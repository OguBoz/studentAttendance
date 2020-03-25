<?php include './inc/header.php'; ?>
<?php include './lib/Student.php'; ?>    
<?php
$student = new Student();

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];

    $insert = $student->addStudent($name, $roll);

    if($insert) {
        $msg = "Record successfully inserted!";
    } else {
        $error = "Error in insertion!";
    }
}

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><a href="add.php" class="btn btn-success">Add Student</a>
                <a href="index.php" class="btn btn-info pull-right">View All</a>       
            </h2>
        </div>
        <div class="panel-body">
            <?php if(isset($error)) {echo "<div class='alert alert-danger'>". $error ."</div>";}?>
            <?php if(isset($msg)) {echo "<div class='alert alert-success'>". $msg ."</div>";}?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter student name..." class="form-control">
                </div>
                <div class="form-group">
                    <label for="roll">Student Roll</label>
                    <input type="text" name="roll" id="roll" placeholder="Enter student roll..." class="form-control">
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
<?php include './inc/footer.php'; ?>
