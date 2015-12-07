<?php
session_start();
 if(!isset($_SESSION['db_user_id']))
 {
	header('Location: login_page.php');
	exit;
 }	

?>
<!DOCTYPE HTML>
<html>
<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Bookshelf</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
			<link type="text/css" rel="stylesheet" href="bookshelf.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
</head>

<body>
 	<div class="nav">
 		<div class="container">
 			<ul class="pull-left">
 				<li><a href="home.html">Home</a></li>
 				<li><a href="about_us.html">About Us</a></li>
 				<li><a href="team.html">Team</a></li>
				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li> 		
 			</ul>
		
 			<ul class="pull-right">
 				<li><form action="signout.php" method="post"><input type="submit" value="Sign out" style="display:inline-block;position:relative;float:right;"></form></li>
				<li><a href="home.html.html">Login/Sign-Up</a></li>			
 				<li class="dropdown">
 					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li>
 					  </ul>
 				</li>
					
 			</ul>
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Bookshelf<p>
	</div>

<div class="table-responsive">
	<table class="table table-hover">
	  <thead>
		  <tr>
	  	<th><strong>S. NO.</strong></th>
		<th><strong>IMAGE</strong></th>
		<th><strong>BOOK NAME/AUTHOR</strong></th>
		<th><strong>NOTES</strong></th>
		<th><strong>ACTION</strong></th>
		  </tr>
	  </thead>
	  <?php
		$sno=1;
		
	  $db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","");
			$select=$db->prepare("SELECT `isbn`,`book_name`,`author`,`subject`,`edition`,`rent`,`note_one`,`note_one_path`,`note_two`,`note_two_path` FROM books WHERE `db_user_id`={$_SESSION['db_user_id']};");
			$select->execute();
			$mybooks=$select->fetchAll();
				foreach($mybooks as $singlebook)
				{
						//serial
						echo "<tbody><tr><td>".$sno++."</td>";
						//for image
						echo "<td class='img'>img</td>";
						echo "<td> {$singlebook['book_name']} / {$singlebook['author']}</td>";
						
						
						if($singlebook['note_one']!='none')
						echo "<td><a href='resources/{$singlebook['note_one_path']}{$singlebook['note_one']}'>{$singlebook['note_one']}</a></td>";
						else
						echo "<td>none</td>";
						
						echo "<td>
								<button type='button' class='btn btn-info'>Sell</button>
								<button type='button' class='btn btn-info'>Rent</button>
							</td>";
						
				}
	  $db=null;
	  
	    ?>
	  
	</table>
</div>
</body>
</html>
