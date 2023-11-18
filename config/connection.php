<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=hotel_reservation_system", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  ?>