<?php
include('class_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sec_id'])) {
    $sec_id = $_GET['sec_id'];

    // เชื่อมต่อฐานข้อมูล
    $conn = new class_conn();
    $con = $conn->connect();

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM tb_section WHERE sec_id = $sec_id";

    if (mysqli_query($con, $sql)) {
        // เมื่อลบข้อมูลสำเร็จ ทำการ redirect ไปยังหน้า show_section.php
        header("Location: show_section.php");
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
