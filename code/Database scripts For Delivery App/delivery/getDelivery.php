
<?php

require "conn.php";

$mysql_qry = "SELECT * from orders";

$query = mysqli_query($conn, $mysql_qry);


$result = array();
 
while($row = mysqli_fetch_array($query)){
array_push($result,
array('id'=>$row[0],
'name'=>$row[3],
'address'=>$row[6],
'mobile'=>$row[5],
'delivery_time'=>$row[16],
'delivery_person'=>$row[21]
));
}
 
echo json_encode(array("result"=>$result));
 
mysqli_close($conn);
?>
