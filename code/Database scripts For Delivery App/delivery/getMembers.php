
<?php

require "conn.php";

$result = array();

               $totalSum = 0;
               $totalDeliveries = 0;
               $i = 0;
               $dp = array();
               $total = array();
               $deliveries = array();

               $sql3="SELECT * FROM delivery_persons";
               $result3 = mysqli_query($conn, $sql3);
               while($row3 = mysqli_fetch_array($result3)){
                 $dp[$i] = $row3['username'];
                 $total[$i] = 0;
                 $deliveries[$i] = 0;
                 $i++;
               }

               $totaldp = count($dp);

               $sql2="SELECT * FROM orders";
               $result2 = mysqli_query($conn, $sql2);

                 while($row = mysqli_fetch_array($result2)){
                   $date = strtotime($row['orderdate']);
                   $dpname = $row['delivery_person'];
                   $location = $row['location'];
                   $price = $row['total'];

                   if((date('Y', $date) == date('Y')) && (date('m', $date) == date('m')) && (date('d', $date) == date('d'))){
                     for($ii=0; $ii<$totaldp;$ii++){
                       if($dp[$ii] == $dpname){
                         $total[$ii] = $total[$ii] + $price;
                         $deliveries[$ii]++;
                         $totalDeliveries++;
                         $totalSum = $totalSum + $price;
                       }
                     }
                   }
                 }

                 for($index=0;$index<$totaldp;$index++){
                         array_push($result,
                         array(
                         'name'=>$dp[$index],
                         'deliveries'=>$deliveries[$index],
                         'amount'=>$total[$index],
                         ));
                 }

echo json_encode(array("result"=>$result));

mysqli_close($conn);
?>
