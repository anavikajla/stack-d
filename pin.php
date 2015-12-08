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
			
			<link type="text/css" rel="stylesheet" href="pin.css">
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
 					  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in,mihika.sood@ashoka.edu.in,paras.bhattrai@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li> 
 					  </ul>
 				</li>
 				<li><form action="signout.php" method="post" style="display:inline-block;"><input type="submit" value="Sign out" style="display:inline-block;position:relative;float:right;"></form></li>
 			</ul>
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Bookshelf<p>
	</div>
	
	<div id="wrapper">
	<div id="columns">
		  <?php
		$sno=1;
		$form_number=0;
		
		$db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","server");
			$select=$db->prepare("SELECT `isbn`,`book_name`,`author`,`subject`,`edition`,`rent`,`sell`,`note_one`,`note_one_path`,`note_two`,`note_two_path` FROM books WHERE `db_user_id`={$_SESSION['db_user_id']};");
			$select->execute();
			$mybooks=$select->fetchAll();
				foreach($mybooks as $singlebook)
				{
						$form_number++;
						echo "<div class='pin' onclick='form_submit({$form_number});'>";
						
						//for image
						if($singlebook['note_one']!="none")
						echo "<img src='book_images/{$singlebook['note_one_path']}{$singlebook['note_one']}' />";
						else
						echo "<img src='http://www.islandpress.org/sites/default/files/400px%20x%20600px-r01BookNotPictured.jpg' />";
						
						echo "<h4 name='book_name'>{$singlebook['book_name']}</h4>";
						echo "<p><strong>Author:</strong><span name='author'>{$singlebook['author']}</span></p>";
						echo "<p><strong>Publisher:</strong><span name='subject'>{$singlebook['subject']}</span></p>";
						echo "<p><strong>Edition:</strong><span name='edition'>{$singlebook['edition']}</span></p>";
						echo "<p><strong>Renting In Price:</strong><span name='rent'>{$singlebook['rent']}</span></p>";
						echo "<p><strong>Selling Price:</strong><span name='sell'>{$singlebook['sell']}</span></p>";
						//echo "<p><a href='' class='btn btn-primary' role='button'>Sell</a> <a href='' class='btn btn-default' role='button'>Rent Out</a></p>";
						
						echo "</div>";
						/*
						if($singlebook['note_one']!='none')
						echo "<td><a href='resources/{$singlebook['note_one_path']}{$singlebook['note_one']}'>{$singlebook['note_one']}</a></td>";
						else
						echo "<td>none</td>";
						
						echo "<td>
								<button type='button' class='btn btn-info'>Sell</button>
								<button type='button' class='btn btn-info'>Rent</button>
							</td>";
						*/
						
						//for form submission
						echo "<form method='post' action='book_profile.php' id='{$form_number}'> ";
						//image
						if($singlebook['note_one']!="none")
						echo "<input name='image' value='book_images/{$singlebook['note_one_path']}{$singlebook['note_one']}' hidden/>";
						else
						echo "<input name='image' value='http://www.islandpress.org/sites/default/files/400px%20x%20600px-r01BookNotPictured.jpg' hidden/>";
						//for notes
						if($singlebook['note_two']!="none")
						{
							echo "<input name='note' value='resources/{$singlebook['note_two_path']}{$singlebook['note_two']}' hidden/>";
							echo "<input name='note_name' value='{$singlebook['note_two']}' hidden/>";
						}	
						else
						echo "<input name='note' value='none' hidden/>";
						
						
						echo"
							<input name='book_name' value='{$singlebook['book_name']}' hidden>
							<input name='isbn' value='{$singlebook['isbn']}' hidden>
							<input name='rent' value='{$singlebook['rent']}' hidden>
							<input name='sell' value='{$singlebook['sell']}' hidden>
							<input name='author' value='{$singlebook['author']}' hidden>
							<input name='subject' value='{$singlebook['subject']}' hidden>
							<input name='edition' value='{$singlebook['edition']}' hidden>
						</form>";
				}
	  $db=null;
	  
	    ?>
	
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
<script>
var doc_id;
function form_submit(doc_id)
{
document.getElementById(doc_id).submit();
}
</script>
</html>
