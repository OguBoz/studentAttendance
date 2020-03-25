<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');

class Student {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudents() {
        $query = "SELECT * FROM students";

        $result = $this->db->select($query);

        return $result;
    }

    public function addStudent($name, $roll) {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $roll = mysqli_real_escape_string($this->db->link, $roll);

        if(empty($name) || empty($roll)) {
            return false;
        }

        $query = "INSERT INTO students(name, roll) VALUES('$name', '$roll')";

        $result = $this->db->insert($query);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertAttendance($attendance, $date) {
        $query = "SELECT DISTINCT att_time FROM attendance";

        $res = $this->db->select($query);

        if($row = $res->fetch_assoc()) {
            if($row['att_time'] == $date) {
                return false;
            }
        }

        $flag = true;
        if(count($attendance) == 0 || empty($date)) {
            return false;
        }

        foreach($attendance as $roll => $attend) {
            $query = "INSERT INTO attendance(roll, attend, att_time) VALUES('$roll', '$attend', '$date')";
            $result = $this->db->insert($query);
            if(!$result) {
                $flag = false;
            }
        }
        return $flag;
    }

    public function getDateList() {
        $query = "SELECT DISTINCT att_time FROM attendance";
        $res = $this->db->select($query);
        return $res;
    }

    public function getStudentsAttendance($dt) {
        $query = "SELECT * FROM students INNER JOIN attendance
                  ON students.roll = attendance.roll
                  WHERE attendance.att_time = '$dt'"; 

        $result = $this->db->select($query);

        return $result;
    }

    public function updateAttendance($attendance, $dt) {
        $flag = true;
        foreach($attendance as $roll => $attend) {
            $query = "UPDATE attendance SET attend = '$attend' WHERE roll = '$roll' AND att_time = '$dt'";
            $result = $this->db->update($query);
            if(!$result) {
                $flag = false;
            }
        }
        return $flag;
    }
}
?> 