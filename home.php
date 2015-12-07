<?php
 session_start();
 if(!isset($_SESSION['db_user_id']))
 {
  header("Location : login_page.php");
  exit;
 }
?>
<!DOCTYPE HTML>
<html>

<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Home</title>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
			<link type="text/css" rel="stylesheet" href="home.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
</head>

<body>
 	<div class="nav">
 		<div class="container">
 			<ul class="pull-left">
 				<li><a href="home.php">Home</a></li>
 				<li><a href="about_us_h.html">About Us</a></li>
 				<li><a href="team_h.html">Team</a></li>		
 			</ul>
		
 			<ul class="pull-right">
 				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li>
 				<li class="dropdown">
 					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in,mihika.sood@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li>
 						<li><a href="#">Contact Form</a></li> 
 					  </ul>
 				
 				</li>
 				<li><form action="signout.php" method="post" style="display:inline-block;"><input type="submit" value="Sign out" style="display:inline-block;position:relative;float:right;"></form></li>
 				 
 			</ul>
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Stack'd<p>
	</div>
	<!--
	<form action="#">
	<button type="button" class="btn btn-info">Profile</button>
    </form>
	
	<form action="home.html">
	<input type="button" class="btn btn-info" value="My Bookshelf" onclick="window.location.href=bookshelf.php">
	</form>
	-->
	<a href="pin.php"><button type="button" class="btn btn-info">My Bookshelf</button></a>
	<a href="trial.php"><button type="button" class="btn btn-info">Add to Bookshelf</button></a>
	<a href="buy_search.html"><button type="button" class="btn btn-info">Buy/Rent</button></a>
	

	
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
</body>
