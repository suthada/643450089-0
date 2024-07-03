<?php
include('class_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new class_conn();
    $con = $conn->connect();

    $sec_name = $_POST['sec_name'];

    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล
    $sql = "INSERT INTO tb_section (sec_name) VALUES ('$sec_name')";

    if (mysqli_query($con, $sql)) {
        // เมื่อเพิ่มข้อมูลสำเร็จ ทำการ redirect ไปยังหน้า show_section.php
        header("Location: show_section.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
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
    <h2>Add Section</h2>
    <form action="add_section.php" method="POST">
        <label for="sec_name">Section Name:</label>
        <input type="text" id="sec_name" name="sec_name" required>
        <button type="submit">Add Section</button>
    </form>
    </div>
</body>
</html>
