<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?php echo $_POST['book_name'];?></title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
			<link type="text/css" rel="stylesheet" href="book_profile.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
</head>

<body>
 	<div class="nav">
 		<div class="container">
 			<ul class="pull-left">
 				<li><a href="home.php">Home</a></li>
 				<li><a href="about_us.html">About Us</a></li>
 				<li><a href="team.html">Team</a></li>
 			</ul>
		
 			<ul class="pull-right">
 				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li>			
 				<li class="dropdown">
 					  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in,mihika.sood@ashoka.edu.in,paras.bhattrai@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li> 
 					  </ul>
 				</li>
 			
			<li><form action="signout.php" method="post" style="display:inline-block;"><input type="submit" value="Sign out" class="btn btn-primary" style="display:inline-block;position:relative;float:right;"></form></li>
			</ul>		
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Stack'd<p>
	</div>

<div class="media">
	<img src="<?php echo htmlspecialchars($_POST['image']);?>" class='img-thumbnail img_size' />
	<div style="display:inline-block; vertical-align:right; margin-left:15%;">
		<h2><strong><?php echo $_POST['book_name'];?></strong></h2>
		<h4 style="color:grey"><?php echo htmlspecialchars($_POST['author']);?></h4>
		<h4 style="color:grey"><?php echo 'ISBN : '.htmlspecialchars($_POST['isbn']);?></h4>
		<br>
		<p><strong>Publisher:</strong><?php echo htmlspecialchars($_POST['subject']);?></p>
		<br>
		<p><strong>Edition:</strong><?php echo htmlspecialchars($_POST['edition']);?></p>
		<br>
		
		<p><strong>Rent price:</strong><?php echo htmlspecialchars($_POST['rent']);?></p>
		<br>
		<p><strong>Sale Price:</strong><?php echo htmlspecialchars($_POST['sell']);?></p>
		<br>
		
		<p><strong>Seller id:</strong>
				<?php
				
					//to produce user email
					$db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","server");
					$select=$db->prepare("SELECT `email` FROM `book_sharing`.`users` where `db_user_id`={$_SESSION['db_user_id']};");
					$select->execute();
					$result=$select->fetch();
					echo $result[0];
					$db=null;
				?>
		<br><br>
		<h4 style="color:grey">Notes</h4>
		
		<p><?php 
		if($_POST['note']!='none')
		echo "<a href='{$_POST['note']}'> {$_POST['note_name']} </a>";
		else
		echo "Not available";
		?>
		</p>
		<br><br>
	</div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>

</body>
</html>
</body>
