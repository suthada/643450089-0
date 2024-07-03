<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Section</title>
    <style>
        .table-container {
            margin-left: 250px; /* ระยะห่างจากขอบซ้าย */
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <tr>
                <th>รหัสแผนก</th>
                <th>ชื่อแผนก</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
            include('class_conn.php'); // ตรวจสอบให้แน่ใจว่ามีการรวมไฟล์ class_conn.php
            $conn = new class_conn();
            $con = $conn->connect();

            $sql = "SELECT sec_id, sec_name FROM tb_section";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["sec_id"] . "</td>";
                    echo "<td>" . $row["sec_name"] . "</td>";
                    echo "<td><a href='edit_section.php?sec_id=" . $row["sec_id"] . "'>แก้ไข</a></td>"; // เพิ่มลิงก์แก้ไข
                    echo "<td><a href='delete_section.php?sec_id=" . $row["sec_id"] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้หรือไม่?\")'>ลบ</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No results found</td></tr>";
            }

            mysqli_close($con);
            ?>
        </table>
    </div>
</body>
</html>
