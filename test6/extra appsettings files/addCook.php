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


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['addCook'])) {

	$q2=$_POST['name'];
       $q2=urldecode($q2);

	$q3=$_POST['email'];
       $q3=urldecode($q3);

	$q4=$_POST['address'];
       $q4=urldecode($q4);

    $mobile = $_POST['mobile'];

    if (!empty($q2) && !empty($q3) && !empty($q4) && !empty($mobile) && strlen($mobile) >= 8)
	{
	$q2 = htmlentities(stripslashes($q2), ENT_QUOTES);
	$q3 = htmlentities(stripslashes($q3), ENT_QUOTES);
	$q4 = htmlentities(stripslashes($q4), ENT_QUOTES);
	$mobile = htmlentities(stripslashes($mobile), ENT_QUOTES);
  $date = date('Y-m-d');

	mysql_query("INSERT INTO cook_person (name, email, mobile, address, orderdate) VALUES ('$q2', '$q3',  '$mobile', '$q4', '$date')");

	}

  header('Location:addCook.php');

}


?>
<!DOCTYPE HTML>
<head>
<title>Retail</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>



<style>
table, th, td {
    border: 1px solid black;
    padding:5px;
    margin: auto;
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
						<p><span>Add Cook</p>
					</div>
					</div>

			 <div class="clear"></div>
  		</div>
   		</div>
   </div>
   <!------------End Header ------------>
  <div class="">
  	<div class="wrap">
      <div class="content">
    					  <div class="contact-formadmin">

					    <form action="" method="post" enctype="multipart/form-data">

						    <div>
						     	<p><label>Name</label></p>
						    	<p><input name="name" type="text" class="textbox"></p>
						    </div>
						    <div>
						     	<p><label>Email</label></p>
						    	<p><input name="email" type="text" class="textbox"></p>
						    </div>


						    <div>
						    	<p><label for="mobile-number">Mobile number:</label></p>
						    	<p><input id="mobile-number" name="mobile" typ e="number" pattern="^\d{8,12}$"
						    					 oninvalid="setCustomValidity('Please enter a valid mobile number')"
						    					 onchange="try{setCustomValidity('')}catch(e){}" class="textbox" /></p>
						    </div>
						    <div>
						     	<p><label>Address</label></p>
						    	<p><input name="address" type="text" class="textbox"></p>
						    </div>

						   <div>
						   		<p><input type="submit" value="Submit"  class="mybutton" name="addCook"></p>
						  </div>
					    </form>
				  </div>


       </div>
  </div>
</div>



   <div class="footer">
   	  <div class="wrap">
			 <div class="copy_right">
				<p>Retail © All rights Reseverd</p>
		   </div>
        </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>
