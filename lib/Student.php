<?php
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/database.php");
 ?>

<?php

    class Student{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }

        public function getAllStudents(){
            $query = "SELECT * FROM tbl_student";
            $result = $this->db->select($query);
            return $result;

        }
        public function insertStudent($name, $roll){
            $name = mysqli_real_escape_string($this->db->link, $name);
            $roll = mysqli_real_escape_string($this->db->link, $roll);
            if (empty($name) || empty($roll)) {

                $msg= "<div class='alert alert-danger'>Error !<strong>Field must not be empty ! </strong></div>";
                return $msg;
            }else {
                $query = "INSERT INTO tbl_student(name, roll) VALUES('$name','$roll')";
                $stu_insert= $this->db->insert($query);

                if ($stu_insert) {
                    return "<div class='alert alert-success'>Success !<strong> Student data inserted successfully. </strong></div>";
                }else {
                    return "<div class='alert alert-danger'>Error !<strong> Student data not inserted. </strong></div>";
                }

                
            }
            

        }

        public function insertAttendance($cur_date,$attend){
            $query = "SELECT DISTINCT attend_time from tbl_attendance";
            $getData = $this->db->select($query);
            while ($result = $getData->fetch_assoc()) {
                $db_date = $result["attend_time"];
                if ($cur_date == $db_date) {
                    return "<div class='alert alert-danger'>Error !<strong> Attendance already taken today </strong></div>";
                }
                
            }

            foreach ($attend as $attend_key => $attend_value) {
                if ($attend_value == "present") {
                    $query = "INSERT INTO tbl_attendance(roll,attend,attend_time) VALUES('$attend_key','present','$cur_date')";
                    $attendance_insert= $this->db->insert($query);
                }elseif($attend_value == "absent") {
                    $query = "INSERT INTO tbl_attendance(roll,attend,attend_time) VALUES('$attend_key','absent','$cur_date')";
                    $attendance_insert= $this->db->insert($query);
                }else {
                     return "<div class='alert alert-danger'>Error !<strong> Please fill up the attendance form correctly . </strong></div>";
                }
            }

            if ($attendance_insert) {
                    return "<div class='alert alert-success'>Success !<strong> Attendance data inserted successfully. </strong></div>";
                }else {
                    return "<div class='alert alert-danger'>Error !<strong> Attendance data not inserted. </strong></div>";
                }

        }
    }
?>