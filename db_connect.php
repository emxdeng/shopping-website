<?php
// Connect to the database
$servername = "awseb-e-7rnzeptzgn-stack-awsebrdsdatabase-w1n3sc5bhctd.ctd4msvmglrt.us-east-1.rds.amazonaws.com:3306";
$username = "uts";
$password = "password";
$dbname = "uts";
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check if the connection was successful
if (!$conn) {
  die("Could not connect to Server: " . mysqli_connect_error());
}
?>

