<?php
class class_conn {
    public $db_server = "localhost";
    public $db_username = "root"; // ชื่อผู้ใช้
    public $db_password = ""; // รหัสผ่าน
    public $db_database = "db_ex3";

    public function connect() {
        $con = mysqli_connect($this->db_server, $this->db_username, $this->db_password, $this->db_database);

        if ($con) {
            mysqli_set_charset($con, "utf8");
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $con;
    }
}
?>
