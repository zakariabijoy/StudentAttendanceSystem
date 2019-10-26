<?php 
    require_once ("include/header.php");
    require_once ("lib/Student.php");
?>
<?php
    $stu = new Student();
    $cur_date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $cur_date = $cur_date->format("d-m-y");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $attend = isset($_POST["attend"])?  $_POST["attend"] : '' ;
        
       
        $insertAttend = $stu->insertAttendance($cur_date,$attend);

    }
?>
<?php
    if (isset($insertAttend)) {
        echo  $insertAttend;
    }
?>

        <div class="card card-default">
            <div class="card-header ">
                <h2>
                    <a class="btn btn-success " href="add.php">Add Student</a>
                    <a class="btn btn-info float-right " href="">View All</a>
                </h2>
            </div>
            <div class="card-body">
                <div class="card text-center">
                    <h4>
                        <strong>Date:</strong> <?php echo $cur_date ?>
                    </h4>
                   
                </div>
                <form action="" method="post">
                    <table class="table table-striped">
                        <tr>
                            <th width="25%">Serial</th>
                            <th width="25%">Student Name</th>
                            <th width="25%">Student Roll</th>
                            <th width="25%">Attendance</th>
                            
                        </tr>
<?php
    $getAllStudents = $stu->getAllStudents();
    if ($getAllStudents) {
        $i = 0;
        while ($value = $getAllStudents->fetch_assoc()) {
            $i++;
?>
                        
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value["name"]; ?></td>
                            <td><?php echo $value["roll"]; ?></td>
                            <td>
                                <input type="radio" name="attend[<?php echo $value["roll"]; ?>]" value="present">P
                                <input type="radio" name="attend[<?php echo $value["roll"]; ?>]" value="absent">A

                            </td>
                        </tr>
<?php
        }
    }
?>
                        
                    </table>
                    <input type="submit" class="btn btn-primary float-right" name="submit" value="Submit">
                </form>

            </div>
<?php
    require_once ("include/footer.php");
 ?>
           
        