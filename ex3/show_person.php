<?php include ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Person</title>
    <style>
        .table-container {
            margin-left: 250px;
            /* ระยะห่างจากขอบซ้าย */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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
                <th>รหัสพนักงาน</th>
                <th>ชื่อพนักงาน</th>
                <th>รหัสแผนก</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
            include ('class_conn.php'); // ตรวจสอบให้แน่ใจว่ามีการรวมไฟล์ class_conn.php
            $conn = new class_conn();
            $con = $conn->connect();

            $sql = "SELECT tb_person.person_id, tb_person.person_name, tb_person.sec_id, tb_section.sec_name
        FROM tb_person
        INNER JOIN tb_section ON tb_person.sec_id = tb_section.sec_id";

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["person_id"] . "</td>";
                    echo "<td>" . $row["person_name"] . "</td>";
                    echo "<td>" . $row["sec_id"] . " - " . $row["sec_name"] . "</td>"; // แสดง sec_id และ sec_name ในช่องเดียวกัน
                    echo "<td><a href='edit_person.php?person_id=" . $row["person_id"] . "'>แก้ไข</a></td>";
                    echo "<td><a href='delete_person.php?person_id=" . $row["person_id"] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้หรือไม่?\")'>ลบ</a></td>";
                    echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='3'>No results found</td></tr>"; // ปรับปรุง colspan ให้ตรงกับจำนวนคอลัมน์
            }

            mysqli_close($con);
            ?>
        </table>
    </div>
</body>

</html>