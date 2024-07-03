<?php
include('class_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['person_id'])) {
    $person_id = $_GET['person_id'];

    // เชื่อมต่อฐานข้อมูล
    $conn = new class_conn();
    $con = $conn->connect();

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM tb_person WHERE person_id = $person_id";

    if (mysqli_query($con, $sql)) {
        header("Location: show_person.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "ไม่มีการระบุรหัสแผนกที่ต้องการลบ";
    exit;
}
?>
