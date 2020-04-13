<?php
$servername = ""; //servername ex. localhost
$username = ""; // your username ex. root
$password = "";//password for your database
$database="";//database name
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>