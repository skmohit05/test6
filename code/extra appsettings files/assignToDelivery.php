<?php

session_start();
include 'config/db.php';


if(!isset($_SESSION["admin_logged"])) {
   header("Location:login.php");
}


mysql_query("CREATE TABLE IF NOT EXISTS orders AS SELECT * FROM checkout");
mysql_query("DROP TABLE orders");
mysql_query("CREATE TABLE IF NOT EXISTS orders AS SELECT * FROM checkout");

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {  // check the submitted location from form

  $sql1="SELECT * FROM orders";
  $result1 = mysql_query($sql1);

  foreach (array_keys($_POST['checkBox']) as $key)   // get checkout table id information from all the checked boxes
   {
    $id = $_POST['textId'][$key];   // use this id to update location of orders in checkout table
    $location = $_POST['textLoc'][$key];
    $dp_name = $_POST['textdp'][$key];
    $query = mysql_query("UPDATE orders SET location = '$location', delivery_person = '$dp_name' where id = '$id'");
  }
}

if(isset($_POST['deliveryByLocation'])){

  $sql4="SELECT * FROM orders";
  $result4 = mysql_query($sql4);
  $sql8="SELECT * FROM delivery_persons";
  $result8 = mysql_query($sql8);
  $total_delivery_persons = mysql_num_rows($result8);
  $delivery_persons_index = 0;

  $result = array();
  while ($row_user = mysql_fetch_assoc($result8))
      $result[] = $row_user;


  while($row4 = mysql_fetch_array($result4)){
    $location = $row4['location'];
    $checkout_id = $row4['id'];
    $dp = $result[$delivery_persons_index]['username'];
    $mysql_qry = "UPDATE orders SET delivery_person = '$dp' where id = '$checkout_id'";
    $insert = mysql_query($mysql_qry) or die(mysql_error());

    $delivery_persons_index = $delivery_persons_index + 1;
    if($delivery_persons_index == $total_delivery_persons){
      $delivery_persons_index = 0;
    }
  }

}

?>


<!DOCTYPE HTML>
<html>
<head>
<title>Moremilaga- Order homemade food online</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">
$(function(){
    $("input[type='checkbox']").on('change', function() {
        $(this).closest('tr').toggleClass("selected", this.checked);
    });
});


function disableButtons(){
  var $submit = $('.submit');
  $checkbox = $('input[type=checkbox]');
  $submit.prop('disabled', true);

  $checkbox.on('click', function(){
     if ($("input:checkbox:checked").length > 0) {
         $submit.removeAttr('disabled');
     }
     else {
         $submit.prop('disabled', true);
     }
  });
}
</script>

<style>
.selected {
    background-color: #009688;
    color: #FFF;
}

.submit {
  border-radius : 0;
  margin-top: 10px;
}

.table {
  color:white;font-family:Georgia, Garamond,Serif;
}

.export {
  background-color:#009688;
  padding: 7px 15px;
  color: white;
}

table, th, td {
    border: 1px solid black;
    padding:5px;
    margin:auto;
}

</style>
</head>

<body>
  <div class="header">
		 <div class="headertop_desc">
			<div class="wrap">
				<div class="nav_list">
<?php
// do php stuff

include('menu.html');

?>
				</div>
				<div class="clear"></div>
			</div>
	  	</div>
  	  		<div class="wrap">
				<div class="header_top">
					<div class="logo">
					<div class="logotitle">
						<p><span>Placed Orders</p>
					</div>
					</div>

			 <div class="clear"></div>
  		</div>
   		</div>
   </div>

	<div class="well">
		<div class="row">
			<div class="col-md-12">


				    <?php
    						$sql1="SELECT * FROM orders";
    						$result1 = mysql_query($sql1);
                if(mysql_num_rows($result1) > 0)
                {
                echo "<form target='iframe_b' action='' method='POST'>
        				     <table border='1' id='dataTable'>
        				      <tr bgcolor='#1976D2'>
        		            <th>Select</th>
                        <th>Order Location</th>
                        <th>Delivery Person</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Total</th>
                        <th>Item Price</th>
                        <th>Order Date</th>
                        <th>Status Of Item</th>
                        <th>Display</th>
        				      </tr>";

    						while($row = mysql_fetch_array($result1))
                {
                  $date = strtotime($row['orderdate']);
                  if((date('Y', $date) == date('Y')) && (date('m', $date) == date('m')) && (date('d', $date) == date('d'))){
                  $id=$row['id'];
                  $name=$row['name'];
                  $email=$row['email'];
                  $mobile=$row['mobile'];
                  $address=$row['address'];
                  $total=$row['total'];
                  $itemprice = $row['itemprice'];
                  $orderdate = $row['orderdate'];
                  $orderdate = date("d M Y", strtotime($orderdate));
                  $statusofitem=$row['statusofitem'];
                  if($row['display'] == 'Buy'){
                    $display= "Lunch";
                  }
                  else {
                    $display= "Dinner";
                  }

                     echo "<tr>";
                     echo "<td><input type=\"checkbox\" class=\"case\" name=\"checkBox[".$name."]\" /></td>";
                     echo "<td><select name='textLoc[".$name."]'>
                           <option value=''>-------</option>";

                     $sql2="SELECT * FROM location";
         						 $result2 = mysql_query($sql2);
                     if(mysql_num_rows($result2) > 0)
                     {
                       while($row2 = mysql_fetch_array($result2))
                       {
                           $location = $row2['name'];
                           $loc_id = $row2['id'];
                           echo "<option value='$location'>$location</option>";
                       }
                     }

                    echo  "</select></td>
                           <td><select name='textdp[".$name."]'>
                            <option value=''>-------</option>";

                    $sql3="SELECT * FROM delivery_persons";
                    $result3 = mysql_query($sql3);
                    if(mysql_num_rows($result3) > 0)
                    {
                      while($row3 = mysql_fetch_array($result3))
                      {
                          $dp_name = $row3['username'];
                          $dp_id = $row3['id'];
                          echo "<option value='$dp_name'>$dp_name</option>";
                      }
                    }

                   echo  "</select></td>

                           <td>$name</td>
                           <td>$email</td>
                           <td>$mobile</td>
                           <td>$address</td>
                           <td>$total</td>
                           <td>$itemprice</td>
                           <td>$orderdate</td>
                           <td>$statusofitem</td>
                           <td>$display</td>
                           <input name=\"textId[".$name."]\" value=\"".$id."\" type=\"hidden\" />
                           </tr>";
                   }
    }
                echo "</table>";
                echo '<div align="center">';
                echo "<input type='submit' class='submit btn btn-success' style='margin-right:2px;' value='Send' name='sendToDelivery'>";
        				echo   '</div>
      				        </form>';
              }
             ?>

                   <div class="pull-right">
                     <a href="exportOrders.php" class="export">Export</a>
                   </div>




      </div>
    </div>
  </div>




	<!-- Footer Starts Here ---->
  <div class="footer">
     <div class="wrap">
      <div class="copy_right">
       <p>Retail © All rights Reseverd</p>
      </div>
       </div>
   </div>
	<!-- Footer Ends Here ---->
</body>
</html>
