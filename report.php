<?php
$host = "localhost";
$username = "root";
$password = ""; 
$dbname = "auth";


$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['generate_report'])) {
  
    echo "<h2>Report on Contribution Tracking</h2>";

    echo "<h3>Pledge Report</h3>";
    $sql_pledges = "SELECT * FROM pledges";
    $result_pledges = $conn->query($sql_pledges);
    
    if ($result_pledges->num_rows > 0) {
       
        echo "<table><tr><th>Pledge ID</th><th>Member ID</th><th>Amount</th><th>Pledge Date</th></tr>";
    
        while($row = $result_pledges->fetch_assoc()) {
            echo "<tr><td>".$row["pledge_id"]."</td><td>".$row["member_id"]."</td><td>".$row["amount"]."</td><td>".$row["pledge_date"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

   
    echo "<h3>Contribution Report</h3>";
    $sql_contributions = "SELECT * FROM contributions";
$result_contributions = $conn->query($sql_contributions);

if ($result_contributions->num_rows > 0) {
  
    echo "<table><tr><th>Contribution ID</th><th>Member ID</th><th>Amount</th><th>Contribution Date</th><th>Purpose</th></tr>";

    while($row = $result_contributions->fetch_assoc()) {
        echo "<tr><td>".$row["contribution_id"]."</td><td>".$row["member_id"]."</td><td>".$row["amount"]."</td><td>".$row["contribution_date"]."</td><td>".$row["purpose"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
    echo "<h3>Donation Report</h3>";
    $sql_donations = "SELECT * FROM donations";
    $result_donations = $conn->query($sql_donations);
    
    if ($result_donations->num_rows > 0) {
       
        echo "<table><tr><th>Donation ID</th><th>Member ID</th><th>Amount</th><th>Donation Date</th><th>Purpose</th><th>Payment Method</th></tr>";
    
      
        while($row = $result_donations->fetch_assoc()) {
            echo "<tr><td>".$row["donation_id"]."</td><td>".$row["member_id"]."</td><td>".$row["amount"]."</td><td>".$row["donation_date"]."</td><td>".$row["purpose"]."</td><td>".$row["payment_method"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
} else {
    
    echo '<a href="report.php?generate_report=true">Generate Report on contribution Tracking</a>';
}
?>
