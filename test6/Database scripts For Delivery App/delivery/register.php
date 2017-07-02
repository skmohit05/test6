<?php

require "conn.php";
$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$aadharPanId= $_POST["aadharPanId"];
$password = $_POST["password"];
$due_amount = "0";
$mysql_qry = "insert into delivery_persons (fullname, email, username, phone_number, address, aadhar_pan_id, password) values
               ('$name', '$email', '$username', '$phone', '$address', '$aadharPanId', '$password')";

if($conn->query($mysql_qry) === TRUE){
  echo "Insert successful";
}

else {
  echo "Error: ". $mysql_qry. "<br>". $conn->error;
}

$conn->close();
?>
