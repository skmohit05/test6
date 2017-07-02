
<?php

require "conn.php";

$mysql_qry = "SELECT * FROM cook_person";

$query = mysqli_query($conn, $mysql_qry);

$result = array();
 
while($row = mysqli_fetch_array($query)){
$date = strtotime($row['orderdate']);
 if((date('Y', $date) == date('Y')) && (date('m', $date) == date('m')) && (date('d', $date) == date('d'))){
array_push($result,
array('id'=>$row[0],
'name'=>$row[1],
'mobile'=>$row[3],
'address'=>$row[4],
));
}
}
 
echo json_encode(array("result"=>$result));
 
mysqli_close($conn);
?>
