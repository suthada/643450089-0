<?php include ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Customer</title>
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
                <th>รหัสลูกค้า</th>
                <th>ชื่อลูกค้า</th>
                <th>รหัสพนักงานที่ดูแล</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            <?php
            include ('class_conn.php'); // ตรวจสอบให้แน่ใจว่ามีการรวมไฟล์ class_conn.php
            $conn = new class_conn();
            $con = $conn->connect();

            $sql = "SELECT tb_customer.customer_id, tb_customer.customer_name, tb_person.person_id, tb_person.person_name
        FROM tb_customer
        INNER JOIN tb_person ON tb_customer.person_id = tb_person.person_id";

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["customer_id"] . "</td>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["person_id"] . " - " . $row["person_name"] . "</td>"; // แสดง person_id และ person_name ในช่องเดียวกัน
                    echo "<td><a href='edit_customer.php?customer_id=" . $row["customer_id"] . "'>แก้ไข</a></td>";
                    echo "<td><a href='delete_customer.php?customer_id=" . $row["customer_id"] . "' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้หรือไม่?\")'>ลบ</a></td>";
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