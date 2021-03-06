<?php include './inc/header.php'; ?>    
<?php include './lib/Student.php'; ?>    


<script type="text/javascript">

$(document).ready(function() {
    $("form").submit(function() {
        var roll = true;
        $(":radio").each(function() {
            name = $(this).attr('name');
            if(roll && !$(':radio[name="' + name + '"]:checked').length) {
                $('.alert').show();
                roll = false;
            }
        });
        return roll;
    });
});

</script>


<?php
$student = new Student();
$cur_date = date('Y-m-d');
?>

<?php
if(isset($_POST['submit'])) {
    $attendance = $_POST['attendance'];

    $insert = $student->insertAttendance($attendance, $cur_date);

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
                <a href="date_view.php" class="btn btn-info pull-right">View All</a>       
            </h2>
        </div>
        <br>
        <div class='alert alert-danger' style="display: none;">Fill in attendance for all students!</div>
        <?php if(isset($error)) {echo "<div class='alert alert-danger'>". $error ."</div>";}?>
            <?php if(isset($msg)) {echo "<div class='alert alert-success'>". $msg ."</div>";}?>
        <div class="panel-body">
            <div class="well text-center" style="font-size:1.8rem;">
                <strong>Today: </strong> <?php $date = date("Y-m-d"); echo $date; ?>
            </div>
            <form action="" method="post">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Student</th>
                        <th>Student Roll</th>
                        <th>Attendance</th>
                    </tr>

                <?php
                    $students = $student->getStudents();
                    if($students) {
                        $i = 0;
                        while($row = $students->fetch_assoc()) {
                            $i++;
                ?>

                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['roll'];?></td>
                        <td>
                            <input type="radio" name="attendance[<?php echo $row['roll'];?>]" value="present"> P 
                            <input type="radio" name="attendance[<?php echo $row['roll'];?>]" value="absent"> A
                        </td>
                    </tr>
                <?php }
                }?>
                </table>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
            </form>

        </div>
    </div>
<?php include './inc/footer.php'; ?>