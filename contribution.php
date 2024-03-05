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
  
    $member_id = $_POST["member_id"];
    $amount = $_POST["amount"];
    $contribution_date = $_POST["contribution_date"];
    $purpose = $_POST["purpose"];

    $sql = "INSERT INTO contributions (member_id, amount, contribution_date, purpose) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $member_id, $amount, $contribution_date, $purpose);

    if ($stmt->execute()) {
        header("Location: contribution_success.php");
        exit();
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
