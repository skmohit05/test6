<?php
session_start();
//error_reporting(E_ALL);
//// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


if(!isset($_SESSION["admin_logged"])) {
   header("Location:login.php");
}



include 'config/db.php';

?>

<!DOCTYPE HTML>
<head>
<title>Retail</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<script>
    $(document).ready(function(){
        var date_input=$('input[name="startdate"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

        var date_input=$('input[name="enddate"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>


<style>
table, th, td {
    border: 1px solid black;
    padding-left:15px;
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
						<p><span>Delivery Analysis</p>
					</div>
					</div>

			 <div class="clear"></div>
  		</div>
   		</div>
   </div>
   <!------------End Header ------------>
  <div class="main">
  	<div class="wrap">
      <div class="content">

        <div class="bootstrap-iso">
         <div class="container-fluid">
          <div class="row">
           <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="well">
              <!-- Form code begins -->
              <form action="" method="post">
                <div class="form-group"> <!-- Date input -->

                    <div style="display:inline-block;"><label class="control-label" for="date">Start Date</label>
                    <input class="form-control" id="date" name="startdate" placeholder="YYYY-MM-DD" type="text"/></div>


                    <div style="display:inline-block;"><label class="control-label" for="date">End Date</label>
                    <input class="form-control" id="date" name="enddate" placeholder="YYYY-MM-DD" type="text"/></div>
                    <button class="btn btn-primary " name="submitDate" type="submit">Submit</button>

                </div>
                <div class="form-group"> <!-- Submit button -->

                  <button class="btn btn-primary " name="today" type="submit">Today</button>
                </div>
               </form>
               <!-- Form code ends -->
            </div>

             <?php

             if (($_SERVER['REQUEST_METHOD'] == 'POST')) {

               $totalSum = 0;
               $totalDeliveries = 0;
               $i = 0;
               $i2 = 0;
               $dp = array();
               $total = array();
               $deliveries = array();

               $loc = array();
               $deliveriesByLoc = array();

               $sql4="SELECT * FROM location";
               $result4 = mysql_query($sql4);
               while($row4 = mysql_fetch_array($result4)){
                 $loc[$i2] = $row4['name'];
                 $deliveriesByLoc[$i2] = 0;
                 $i2++;
               }

               $totalLoc = count($loc);

               $sql3="SELECT * FROM delivery_persons";
               $result3 = mysql_query($sql3);
               while($row3 = mysql_fetch_array($result3)){
                 $dp[$i] = $row3['username'];
                 $total[$i] = 0;
                 $deliveries[$i] = 0;
                 $i++;
               }

               $totaldp = count($dp);

             	$q2=$_POST['startdate'];

             	$q3=$_POST['enddate'];

               $startdate = strtotime($q2);
               $enddate = strtotime($q3);


               $sql2="SELECT * FROM orders";
               $result2 = mysql_query($sql2);
               if(isset($_POST['submitDate'])){
                 while($row = mysql_fetch_array($result2)){
                   $date = strtotime($row['orderdate']);
                   $dpname = $row['delivery_person'];
                   $location = $row['location'];
                   $price = $row['total'];

                   if((date('Y', $date) == date('Y', $startdate)) && (date('m', $date) == date('m', $startdate)) && (date('d', $date) >= date('d', $startdate)) && (date('d', $date) <= date('d', $enddate))){
                     for($ii=0; $ii<$totaldp;$ii++){
                       if($dp[$ii] == $dpname){
                         $total[$ii] = $total[$ii] + $price;
                         $deliveries[$ii]++;
                         $totalDeliveries++;
                         $totalSum = $totalSum + $price;
                       }
                     }

                     for($ii2=0; $ii2<$totalLoc;$ii2++){
                       if($loc[$ii2] == $location){
                         $deliveriesByLoc[$ii2]++;
                       }
                     }
                   }
                 }
               }

               else if(isset($_POST['today'])){
                 while($row = mysql_fetch_array($result2)){
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

                     for($ii2=0; $ii2<$totalLoc;$ii2++){
                       if($loc[$ii2] == $location){

                         $deliveriesByLoc[$ii2]++;
                       }
                     }

                   }
                 }
               }

               $q22 = date("d M Y", strtotime($q2));
               $q32 = date("d M Y", strtotime($q3));

               echo "<br>
                     <div class='well'>";

                if(isset($_POST['submitDate'])){
                  echo "<div style='text-align:center;'>
                          <a style='padding:5px;background:white;  border: 1px solid black; '>$q22 To $q32</a>
                        </div>";
                }
                else if(isset($_POST['today'])){
                  $today = date("d M Y");
                  echo "<div style='text-align:center;'>
                          <a style='padding:5px;background:white;  border: 1px solid black; '>Date Today: $today</a>
                        </div>";

                }
               echo "</div>";


               echo "<div class='well'>
                     <table class='table'>
                     <tr bgcolor='#1976D2'>
                       <th>#</th>
                       <th>Delivery Person</th>
                       <th>Total Deliveries</th>
                       <th>Total Amount</th>
                     </tr>";

               for($index=0;$index<$totaldp;$index++){
                 echo "<tr><td>";
                 echo $index+ 1;
                 echo "</td>
                       <td>$dp[$index]</td>
                       <td>$deliveries[$index]</td>
                       <td>$total[$index]</td>
                       </tr>";
               }

               echo "<tr>
                     <td></td>
                     <td>Total</td>
                     <td>$totalDeliveries</td>
                     <td>$totalSum</td>
                     </tr></table></div>";


                     echo "<div class='well'>
                           <table class='table'>
                           <tr bgcolor='#1976D2'>
                             <th>#</th>
                             <th>Location</th>
                             <th>Total Deliveries</th>
                           </tr>";

                     for($index2=0;$index2<$totalLoc;$index2++){
                       echo "<tr><td>";
                       echo $index2+ 1;
                       echo "</td>
                             <td>$loc[$index2]</td>
                             <td>$deliveriesByLoc[$index2]</td>
                             </tr>";
                     }

                     echo "<tr>
                           <td></td>
                           <td>Total</td>
                           <td>$totalDeliveries</td>
                           </tr></table></div>";

             }

            ?>

            </div>
          </div>
         </div>
        </div>

       </div>
  </div>
</div>

</body>
</html>
