<?php
// Include class_conn.php
include('class_conn.php');

// Initialize variables
$customer_id = $customer_name = $person_id = '';

// Check if customer_id is specified in URL (for editing existing customer)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Connect to the database
    $conn = new class_conn();
    $con = $conn->connect();

    // Retrieve customer data to edit
    $sql = "SELECT customer_id, customer_name, person_id FROM tb_customer WHERE customer_id = $customer_id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $customer_name = $row['customer_name'];
        $person_id = $row['person_id'];
    } else {
        echo "Customer not found";
        exit;
    }

    mysqli_close($con);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling form submission (updating customer data)
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $person_id = $_POST['person_id'];

    // Connect to the database
    $conn = new class_conn();
    $con = $conn->connect();

    // Prepare SQL statement for updating customer_name and person_id
    $sql = "UPDATE tb_customer SET customer_name = '$customer_name', person_id = $person_id WHERE customer_id = $customer_id";

    if (mysqli_query($con, $sql)) {
        // If update successful, redirect to a confirmation page or wherever needed
        header("Location: show_customer.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    // If customer_id is not specified in URL and not a POST request
    echo "Invalid request";
    exit;
}

// Fetch persons for dropdown
$conn = new class_conn();
$con = $conn->connect();

$sql = "SELECT person_id, person_name FROM tb_person";
$result = mysqli_query($con, $sql);

$person_options = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $selected = ($row['person_id'] == $person_id) ? 'selected' : '';
        $person_options .= "<option value='" . $row['person_id'] . "' $selected>" . $row['person_name'] . "</option>";
    }
} else {
    $person_options .= "<option value=''>No persons found</option>";
}

mysqli_close($con);
?>
<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
    <h2>Edit Customer</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required>
        <br><br>
        <label for="person_id">Person:</label>
        <select id="person_id" name="person_id" required>
            <?php echo $person_options; ?>
        </select>
        <br><br>
        <button type="submit">Save Customer</button>
    </form>
    </div>
</body>
</html>
