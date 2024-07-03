<?php
// Include class_conn.php
include ('class_conn.php');

// Initialize variables
$person_id = $person_name = $sec_id = '';

// Check if person_id is specified in URL (for editing existing person)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['person_id'])) {
    $person_id = $_GET['person_id'];

    // Connect to the database
    $conn = new class_conn();
    $con = $conn->connect();

    // Retrieve person data to edit
    $sql = "SELECT person_id, person_name, sec_id FROM tb_person WHERE person_id = $person_id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $person_name = $row['person_name'];
        $sec_id = $row['sec_id'];
    } else {
        echo "Person not found";
        exit;
    }

    mysqli_close($con);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling form submission (updating person data)
    $person_id = $_POST['person_id'];
    $person_name = $_POST['person_name'];
    $sec_id = $_POST['sec_id'];

    // Connect to the database
    $conn = new class_conn();
    $con = $conn->connect();

    // Prepare SQL statement for updating person_name and sec_id
    $sql = "UPDATE tb_person SET person_name = '$person_name', sec_id = $sec_id WHERE person_id = $person_id";

    if (mysqli_query($con, $sql)) {
        // If update successful, redirect to a confirmation page or wherever needed
        header("Location: show_person.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    // If person_id is not specified in URL and not a POST request
    echo "Invalid request";
    exit;
}
?>
<?php include ('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Person</title>
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

        .form-container label,
        .form-container select {
            display: block;
            margin-bottom: 10px;
        }

        .form-container input,
        .form-container button[type="submit"] {
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
        <h2>Edit Person</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="person_id" value="<?php echo $person_id; ?>">
            <label for="person_name">Person Name:</label>
            <input type="text" id="person_name" name="person_name" value="<?php echo $person_name; ?>" required>
            <br><br>
            <label for="sec_id">Section Name:</label>
            <select id="sec_id" name="sec_id" required>
                <?php
                // Connect to the database
                $conn = new class_conn();
                $con = $conn->connect();

                // Retrieve department data from tb_section table
                $sql = "SELECT sec_id, sec_name FROM tb_section";
                $result = mysqli_query($con, $sql);

                // Create options in the dropdown
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['sec_id'] == $sec_id) ? 'selected' : '';
                        echo "<option value='" . $row['sec_id'] . "' $selected>" . $row['sec_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No departments found</option>";
                }

                mysqli_close($con);
                ?>
            </select>
            <br><br>
            <button type="submit">Save Person</button>
        </form>
    </div>
</body>

</html>