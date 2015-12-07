<?php
	session_start();
	if(isset($_POST['login'])){
				$db=new PDO("mysql:host=localhost;dbname=book_sharing","root","");
		$uname=htmlspecialchars($_POST['uname']);
		$upass=htmlspecialchars($_POST['upass']);
		$data=$db->prepare("SELECT `db_user_id` FROM `users` WHERE `email` LIKE '{$uname}' AND `password` LIKE '{$upass}';");
		$data->execute();
		$isuser=$data->fetch();
		//print_r($isuser);
		 if(strlen($isuser['db_user_id'])!=0)
		 {
			$_SESSION['db_user_id']=$isuser['db_user_id'];
			$db=null;
			header('Location: home.php');
			exit;
		 }
		 else
		 {
			//if userid password doesn't match
			$wronguser=1;
		 }
		$db=null;
	}
	else if(isset($_POST['signup']))
		{
			//print_r($_POST);
			$db=new PDO("mysql:host=localhost;dbname=book_sharing","root","");
			$sfirst=htmlspecialchars($_POST['sfirst']);
			$slast=htmlspecialchars($_POST['slast']);
			$semail=htmlspecialchars($_POST['semail']);
			$spass=htmlspecialchars($_POST['spass']);
			$loop=true;
			 while($loop)
			 {
				$user_id=rand(0000,9999);
				$select=$db->prepare("SELECT `db_user_id` FROM `book_sharing`.`users` where `db_user_id`={$user_id};");
				$select->execute();
				$result=$select->fetch();
					if(strlen($result)==0)
					$loop=false;
			 }
			$db->exec("INSERT INTO `book_sharing`.`users` (`db_user_id`, `firstname`, `surname`, `email`, `password`) VALUES ('{$user_id}', '{$sfirst}', '{$slast}', '{$semail}', '{$spass}');");
			
			//echo "signed up |||";
			//after signup redirect user to bookshelf
			$data=$db->prepare("SELECT `db_user_id` FROM `users` WHERE `email` LIKE '{$uname}' AND `password` LIKE '{$upass}';");
			$data->execute();
			$isuser=$data->fetch();
		//print_r($isuser);
			if(strlen($isuser['db_user_id'])!=0)
			{
				$_SESSION['db_user_id']=$isuser['db_user_id'];
				$db=null;
				header('Location: home.php');
				exit;
		 }
		 $db=null;
		}
?>

<!DOCTYPE HTML>
<html>

<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Login/Sign Up</title>
			
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			
			<link type="text/css" rel="stylesheet" href="login.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
</head>

<body>
	<div class="nav" role="navigation">
		<div class="container">
			<ul class="pull-left">
				<li><a href="about_us.html">About Us</a></li>
				<li><a href="team.html">Team</a></li>
				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li>		
			</ul>
		
			<ul class="pull-right">
				
				<li class="dropdown">
					  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
						  Contact Us<span class="caret"></span></a>				  
					  <ul class="dropdown-menu">
					    <li><a href="#">Email</a></li>
					    <li><a href="#">Facebook</a></li>
					    <li><a href="#">LinkedIn</a></li>
					    <li><a href="#">Address</a></li>
						
					  </ul>
				</li>
			</ul>
		</div>
	</div>
		
		<div class="header">
			<p id="heading_top">Stack'd<p>
		</div>
		
		<p id="head1">Login or Sign up here</p>
		<p id="head2">It's free and easy!</p>
		
		<!--login form-->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="log" align="center">
		<input type="text" name="uname" class="box" placeholder="Email ID" required>
		<br>
		<input type="password" name="upass" class="box" placeholder="Password" required>
		<br>
		<input type="submit" value="Login" class="btn btn-primary" name="login" href="home.html">
		<br>
		<output id="notmatch1"></output>
		</form>
		<br>		
			
		<!--signup form-->
		<form method="post" id="signupform" action="<?php echo $_SERVER['PHP_SELF']; ?>" align="center">
		<input type="text" name="sfirst" class="box" placeholder="Firstname" required>
		<br>
		<input type="text" name="slast" class="box" placeholder="Lastname">
		<br>
		<input type="email" name="semail" class="box" placeholder="Email ID" required>
		<br>
		<input type="password" id="pass" name="spass" class="box" placeholder="Password" required>
		<br>
		<input type="password" id="confirm" class="box" placeholder="Confirm Password" required >
		<br>
		<input type="submit" value="Signup" class="btn btn-primary" name="signup" onclick="check();">
		<br>
		<output id="notmatch"></output>
		</form>
		<p style="margin-left:28%;font-size:10px">When you sign up you agree to display your e-mail i.d. while selling/renting out books or notes to the Ashoka community.</p>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>
	<script>
		function check(){
			var pass=document.getElementById('pass');
			var confirm=document.getElementById('confirm');
			if(pass.value==confirm.value)
			{
				document.getElementById("signupform").submit();
				//return true;
				
			}
			else
			{
				
				confirm.style.color="red";
				pass.style.color="red";
				document.getElementById('notmatch').style.color="red";
				document.getElementById('notmatch').innerHTML="password doesn't match";
				
				return false;
			}
			
			
			
		}
		<?php 
			if(isset($wronguser))
			{
				echo "document.getElementById('notmatch1').style.color='red';";
				echo "document.getElementById('notmatch1').innerHTML='Wrong username or password';";
			}
		?>
	</script>	
	</body>