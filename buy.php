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
			<title>Buy</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
			<link type="text/css" rel="stylesheet" href="pin.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
</head>

<body>
 	<div class="nav">
 		<div class="container">
 			<ul class="pull-left">
 				<li><a href="home.html">Home</a></li>
 				<li><a href="about_us_h.html">About Us</a></li>
 				<li><a href="team_h.html">Team</a></li>
				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li> 		
 			</ul>
		
 			<ul class="pull-right">
 				<li><a href="login_page.php">Login/Sign-Up</a></li>			
 				<li class="dropdown">
 					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in,mihika.sood@ashoka.edu.in,paras.bhattrai@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li>
 					  </ul>
 				</li>
 			<li><form action="signout.php" method="post"><input type="submit" value="Sign out" class="btn btn-primary" style="display:inline-block;position:relative;float:right;"></form></li>
 			</ul>
				
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">BUY<p>
	</div>
	
	<div id="wrapper">
	<div id="columns">
<?php
			$db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","server");
			if(isset($_POST['search']))
			{	
				//echo "<h3>SEARCH RESULTS</h3>";
				$present_search=htmlspecialchars($_POST['search']);
				$select=$db->prepare("SELECT `isbn`,`book_name`,`author`,`subject`,`edition`,`rent`,`note_one`,`note_one_path`,`note_two`,`note_two_path` FROM books WHERE `book_name` LIKE '{$present_search}' OR `author` LIKE '{$present_search}' OR `isbn` LIKE '{$present_search}';");
				$select->execute();
				$mybooks=$select->fetchAll();
				$form_number=0;
				foreach($mybooks as $singlebook)
				{
						$form_number++;
						echo "<div class='pin' onclick='form_submit({$form_number});'>";
						
						//for image
						echo "<img src='http://d28hgpri8am2if.cloudfront.net/book_images/cvr9780743482820_9780743482820_hr.jpg' />";
						echo "<h1 name='book_name'>{$singlebook['book_name']}</h1>";
						echo "<p><strong>Author:</strong><span name='author'>{$singlebook['author']}</span></p>";
						echo "<p><strong>Publisher:</strong><span name='subject'>{$singlebook['subject']}</span></p>";
						echo "<p><strong>Edition:</strong><span name='edition'>{$singlebook['edition']}</span></p>";
						//echo "<p><a href='' class='btn btn-primary' role='button'>Sell</a> <a href='' class='btn btn-default' role='button'>Rent Out</a></p>";
						
						echo "</div>";
						
						echo "<form method='post' action='book_profile.php' id='{$form_number}'> 
							<input name='image' value='http://d28hgpri8am2if.cloudfront.net/book_images/cvr9780743482820_9780743482820_hr.jpg' hidden>
							<input name='book_name' value='{$singlebook['book_name']}' hidden>
							<input name='author' value='{$singlebook['author']}' hidden>
							<input name='subject' value='{$singlebook['subject']}' hidden>
							<input name='edition' value='{$singlebook['edition']}' hidden>
						</form>";
				}
			}
			$db=null;
	?>
	
</body>

<script>
var doc_id;
function form_submit(doc_id)
{
document.getElementById(doc_id).submit();
}
</script>
</html>
