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
    $pledge_date = $_POST["pledge_date"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO pledges (member_id, amount, pledge_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $member_id, $amount, $pledge_date);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: pledge_success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
