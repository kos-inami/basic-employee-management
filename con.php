<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "basic_employee_mgmt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else {
//     echo "<h1>Connected</h1>";
// }

?>