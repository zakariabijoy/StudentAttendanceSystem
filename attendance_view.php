<?php 
    require_once ("include/header.php");
    require_once ("lib/Student.php");
?>
<?php
    $cur_date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $cur_date = $cur_date->format("Y-m-d");
?>


        <div class="card card-default">
            <div class="card-header ">
                <h2>
                    <a class="btn btn-success " href="add.php">Add Student</a>
                    <a class="btn btn-info float-right " href="index.php">Take Attendance</a>
                </h2>
            </div>
            <div class="card-body">
                <div class="card text-center">
                    <h4>
                        <strong>Today's Date:</strong> <?php echo $cur_date ?>
                    </h4>
                   
                </div>
                <form action="" method="post">
                    <table class="table table-striped">
                        <tr>
                            <th width="30%">Serial</th>
                            <th width="50%">Attendance Date</th>
                            <th width="20%">Action</th>

                            
                        </tr>
<?php
    $stu = new Student();
    $getDateList = $stu->getDateList();
    if ($getDateList) {
        $i = 0;
        while ($value = $getDateList->fetch_assoc()) {
            $i++;
?>
                        
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value["attend_time"]; ?></td>
                            <td>
                                <a class="btn btn-primary" href="student_view.php?dt=<?php echo $value["attend_time"]; ?>">View</a>
                            </td>
                            
                        </tr>
<?php
        }
    }
?>
                        
                    </table>
                    
                </form>

            </div>
<?php
    require_once ("include/footer.php");
 ?>
           
        