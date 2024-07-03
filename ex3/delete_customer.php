<?php
include('class_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // เชื่อมต่อฐานข้อมูล
    $conn = new class_conn();
    $con = $conn->connect();

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM tb_customer WHERE customer_id = $customer_id";

    if (mysqli_query($con, $sql)) {
        header("Location: show_customer.php");
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
