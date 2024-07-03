<?php
// Include database connection class
include('class_conn.php');

// Initialize variables
$person_options = '';
$message = '';

// Create database connection
$conn = new class_conn();
$con = $conn->connect();

// Query to fetch person_id and person_name from tb_person
$sql_person = "SELECT person_id, person_name FROM tb_person";
$result_person = mysqli_query($con, $sql_person);

// Check if there are rows returned
if (mysqli_num_rows($result_person) > 0) {
    while($row_person = mysqli_fetch_assoc($result_person)) {
        $person_options .= '<option value="' . $row_person['person_id'] . '">' . $row_person['person_name'] . '</option>';
    }
} else {
    $person_options = '<option value="">No persons found</option>';
}

// Close database connection
mysqli_close($con);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_name = $_POST['customer_name'];
    $person_id = $_POST['person_id'];
    
    // Create database connection again for inserting data
    $conn = new class_conn();
    $con = $conn->connect();
    
    // SQL statement to insert data into tb_customer
    $sql_insert_customer = "INSERT INTO tb_customer (customer_name, person_id) VALUES ('$customer_name', '$person_id')";
    
    if (mysqli_query($con, $sql_insert_customer)) {
        header("Location: show_customer.php");
    } else {
        $message = "Error: " . mysqli_error($con);
    }
    
    // Close database connection
    mysqli_close($con);
}
?>

<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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
        <h2>Add Customer</h2>
        <?php if (!empty($message)) echo '<p>' . $message . '</p>'; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            
            <label for="person_id">Person:</label>
            <select id="person_id" name="person_id" required>
                <?php echo $person_options; ?>
            </select>
            
            <input type="submit" value="Add Customer">
        </form>
    </div>
</body>
</html>
