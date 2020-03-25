<?php include './inc/header.php'; ?>    
<?php include './lib/Student.php'; ?>    

<?php
$student = new Student();
$cur_date = date('Y-m-d');
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2><a href="add.php" class="btn btn-success">Add Student</a>
                <a href="index.php" class="btn btn-info pull-right">Take Attendance</a>       
            </h2>
        </div>
        <br>
        <?php if(isset($error)) {echo "<div class='alert alert-danger'>". $error ."</div>";}?>
            <?php if(isset($msg)) {echo "<div class='alert alert-success'>". $msg ."</div>";}?>
        <div class="panel-body">
            <form action="" method="post">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Attendance Date</th>
                        <th>Action</th>
                    </tr>

                <?php
                    $dateList = $student->getDateList();
                    if($dateList) {
                        $i = 0;
                        while($row = $dateList->fetch_assoc()) {
                            $i++;
                ?>

                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['att_time'];?></td>
                        <td>
                            <a class="btn btn-primary" href="student_view.php?dt=<?php echo $row['att_time'];?>">View</a>
                        </td>
                    </tr>
                <?php }
                }?>
                </table>
            </form>

        </div>
    </div>
<?php include './inc/footer.php'; ?>