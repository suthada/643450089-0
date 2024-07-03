<?php
// Include class_conn.php
include('class_conn.php');

// ตรวจสอบว่ามีการระบุ sec_id ใน URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sec_id'])) {
    $sec_id = $_GET['sec_id'];

    // เชื่อมต่อฐานข้อมูล
    $conn = new class_conn();
    $con = $conn->connect();

    // ดึงข้อมูลแผนกที่ต้องการแก้ไข
    $sql = "SELECT sec_id, sec_name FROM tb_section WHERE sec_id = $sec_id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $sec_name = $row['sec_name'];
    } else {
        echo "ไม่พบข้อมูลแผนก";
        exit;
    }

    mysqli_close($con);
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // หลังจากกดปุ่มบันทึกการแก้ไข
    $conn = new class_conn();
    $con = $conn->connect();

    $sec_id = $_POST['sec_id'];
    $sec_name = $_POST['sec_name'];

    // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูล sec_name เท่านั้น
    $sql = "UPDATE tb_section SET sec_name = '$sec_name' WHERE sec_id = $sec_id";

    if (mysqli_query($con, $sql)) {
        // เมื่ออัปเดตข้อมูลสำเร็จ ทำการ redirect ไปยังหน้า show_section.php
        header("Location: show_section.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    // กรณีที่ไม่มีการระบุ sec_id หรือไม่ใช่การ POST เข้ามา
    echo "ไม่มีการระบุรหัสแผนกที่ต้องการแก้ไข";
    exit;
}
?>
<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <style>
        /* CSS styles for layout and form */
        .form-container {
            margin-left: 250px;
        }
        .form-container form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container label, .form-container select {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input, .form-container button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>
<div class="form-container">
    <h2>Edit Department</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="sec_id" value="<?php echo $sec_id; ?>">
        <label for="sec_name">Section Name:</label>
        <input type="text" id="sec_name" name="sec_name" value="<?php echo $sec_name; ?>" required>
        <button type="submit">Save Section</button>
    </form>
    </div>
</body>

</html>
