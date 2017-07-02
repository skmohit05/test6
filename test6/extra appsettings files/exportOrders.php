<?php
session_start();

if(!isset($_SESSION["admin_logged"])) {
   header("Location:login.php");
}

include 'config/db.php';
    header("Content-type: application/vnd-ms-excel");

    header("Content-Disposition: attachment; filename=AllocatedOrder-export.xls");

	?>
	<table class="reference"><tbody>

    	<tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Title</th>
        <th>Item Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Order Date</th>
        <th>Status Of Item</th>
        <th>Display</th>
        <th>Order Location</th>
        <th>Delivery Person</th>
		</tr>

	<?php
	$sql1="SELECT * FROM orders GROUP BY randomNumber ORDER BY id DESC";

	$result1 = mysql_query($sql1);

	while($row = mysql_fetch_array($result1))
	{
		$randomNumber=$row['randomNumber'];


		$sql12="SELECT * FROM orders WHERE randomNumber = '$randomNumber'";

		$result12 = mysql_query($sql12);

		while($row12 = mysql_fetch_array($result12))
		{

      $date = strtotime($row['orderdate']);
   if((date('Y', $date) == date('Y')) && (date('m', $date) == date('m')) && (date('d', $date) == date('d'))){
			$name=$row['name'];
			$email=$row['email'];
			$mobile=$row['mobile'];
			$address=$row['address'];
      $title=$row12['itemtitle'];
			$price=$row12['itemprice'];
			$qunatity=$row12['itemquantity'];
			$total=$row['total'];
      $orderdate=$row['orderdate'];
			$statusofitem=$row['statusofitem'];
      if($row['display'] == 'Buy'){
        $display= "Lunch";
      }
      else {
        $display= "Dinner";
      }
      $orderLocation=$row['location'];
      $delivery_person=$row['delivery_person'];


			if(strlen(trim($statusofitem)) < 1){
			   // $string has at least one non-space character
			   $statusofitem = "Yet to Update";
			}

			echo "<tr><td>$name</td><td>$email</td><td>$mobile</td><td>$address</td><td>$title</td><td>$price</td><td>$qunatity</td><td>$total</td><td>$orderdate</td><td>$statusofitem</td><td>$display</td><td>$orderLocation</td><td>$delivery_person</td></tr>";
		}
  }
	?>

	<?php
	}
	?>
		</tbody></table>
