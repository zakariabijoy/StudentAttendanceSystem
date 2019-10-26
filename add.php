<?php 
    require_once ("include/header.php");
    require_once ("lib/Student.php");
?>
<?php
    $stu = new Student();
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $name =$_POST["name"];
        $roll =$_POST["roll"];
        $insertdata = $stu->insertStudent($name,$roll);

    }
?>
<?php
    if (isset($insertdata)) {
        echo  $insertdata;
    }
?>

            <div class="card card-default">
                <div class="card-header ">
                    <h2>
                        <a class="btn btn-success " href="add.php">Add Student</a>
                        <a class="btn btn-info float-right " href="index.php">Back</a>
                    </h2>
                </div>
                <div class="card-body">
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please Enter Student Name" >
                        </div>
                        <div class="form-group">
                            <label for="roll">Student Roll</label>
                            <input type="text" class="form-control" name="roll" id="roll" placeholder="Please Enter Student Roll" >
                        </div>
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Student">
                        </div>
                    </form>

                </div>
<?php
    require_once ("include/footer.php");
 ?>
           
        