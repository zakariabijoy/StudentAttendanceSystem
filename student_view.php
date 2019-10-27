<?php 
    require_once ("include/header.php");
    require_once ("lib/Student.php");
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("form").submit(function(){
            var roll =true;
            $(":radio").each(function() {
                var name = $(this).attr("name");
                if (roll && !$(':radio[name="' +name+ '"]:checked').length) {
                    $(".alert").show();
                    roll =false;
                }
            })
            return roll;
        });
    });
</script>
<?php
    $stu = new Student();
    $dt = $_GET["dt"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $attend = isset($_POST["attend"])?  $_POST["attend"] : '' ;
        
       
        $updateAttend = $stu->updateAttendance($dt,$attend);

    }
?>
<?php
    if (isset($updateAttend)) {
        echo  $updateAttend;
    }
?>

<div class='alert alert-danger' style="display:none">Error !<strong> Student Roll Missing. </strong></div>
        <div class="card card-default">
            <div class="card-header ">
                <h2>
                    <a class="btn btn-success " href="add.php">Add Student</a>
                    <a class="btn btn-info float-right " href="attendance_view.php">Back</a>
                </h2>
            </div>
            <div class="card-body">
                <div class="card text-center">
                    <h4>
                        <strong> Date:</strong> <?php echo $dt ?>
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
    
    $get_student = $stu->getAllData($dt);
    if ($get_student) {
        $i = 0;
        while ($value = $get_student->fetch_assoc()) {
            $i++;
?>
                        
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value["name"]; ?></td>
                            <td><?php echo $value["roll"]; ?></td>
                            <td>
                                <input type="radio" name="attend[<?php echo $value["roll"]; ?>]" value="present" <?php if($value["attend"] == "present") {echo "checked";} ?>>P
                                <input type="radio" name="attend[<?php echo $value["roll"]; ?>]" value="absent" <?php if($value["attend"] == "absent") {echo "checked";} ?>>A
                                

                            </td>
                        </tr>
<?php
        }
    }
?>
                        
                    </table>
                    <input type="submit" class="btn btn-primary float-right" name="submit" value="Update">
                </form>

            </div>
<?php
    require_once ("include/footer.php");
 ?>
           
        