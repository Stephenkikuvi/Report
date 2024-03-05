<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "auth";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $member_id = $_POST["member_id"];
    $amount = $_POST["amount"];
    $donation_date = $_POST["donation_date"];
    $purpose = $_POST["purpose"];
    $payment_method = $_POST["payment_method"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO donations (member_id, amount, donation_date, purpose, payment_method) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $member_id, $amount, $donation_date, $purpose, $payment_method);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: donation_success.php");
        exit();
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $stmt->close();
    $conn->close();
}

