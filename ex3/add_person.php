<?php
include('class_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new class_conn();
    $con = $conn->connect();

    $person_name = $_POST['person_name']; // รับชื่อจากฟอร์ม
    $sec_id = $_POST['sec_id']; // รับ sec_id จากฟอร์ม

    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลลงใน tb_person
    $sql = "INSERT INTO tb_person (person_name, sec_id) VALUES ('$person_name', $sec_id)";

    if (mysqli_query($con, $sql)) {
        // เมื่อเพิ่มข้อมูลสำเร็จ ทำการ redirect ไปยังหน้า show_person.php หรือหน้าอื่นตามที่ต้องการ
        header("Location: show_person.php");
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
    <title>Add Person</title>
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
        .form-container select {
            display: block;
            width: calc(100% - 80px);
            /* ปรับความกว้างให้เต็มขอบฟอร์ม */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Add Person</h2>
    <form action="add_person.php" method="POST">
        <label for="person_name">Person Name:</label>
        <input type="text" id="person_name" name="person_name" required>
        <br><br>
        <label for="sec_id">Section Name:</label>
        <select id="sec_id" name="sec_id" required>
            <?php
            // เชื่อมต่อฐานข้อมูล
            $conn = new class_conn();
            $con = $conn->connect();

            // ดึงข้อมูลแผนกจากตาราง tb_section
            $sql = "SELECT sec_id, sec_name FROM tb_section";
            $result = mysqli_query($con, $sql);

            // สร้างตัวเลือกใน dropdown
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['sec_id'] . "'>" . $row['sec_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No departments found</option>";
            }

            mysqli_close($con);
            ?>
        </select>
        <br><br>
        <button type="submit">Add Person</button>
    </form>
    </div>
</body>
</html>
