<?php

require "conn.php";
$username = $_POST["username"];
$password = $_POST["password"];
$mysql_qry = "select * from delivery_persons where username like '$username' and password like '$password'";

$result = mysqli_query($conn, $mysql_qry);

if(mysqli_num_rows($result) > 0){
  echo "login success";
}

else {
  echo "login not success";
}

$conn->close();

?>
