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
			<title>Buy or Rent </title>
			
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="buy_search.css">
			<link type="image/x-icon" rel="icon" href="favicon1.ico">
			
</head>
<body>

<body>
 	<div class="nav">
 		<div class="container">
 			<ul class="pull-left">
 				<li><a href="page_one.html">Home</a></li>
 				<li><a href="about_us_h.html">About Us</a></li>
 				<li><a href="team_h.html">Team</a></li>	
				<li><a href="https://mihikasood.typeform.com/to/wuNSlj">Feedback Form</a></li>	
 			</ul>
		
 			<ul class="pull-right">
 				<li><a href="login_page.html">Login/Sign-Up</a></li>			
 				<li class="dropdown">
 					  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
 						  Contact Us<span class="caret"></span></a>				  
 					  <ul class="dropdown-menu">
 					    <li><a href="mailto:anavi.kajla@ashoka.edu.in,mihika.sood@ashoka.edu.in,paras.bhattrai@ashoka.edu.in">Email</a></li>
 					    <li><a href="#">Facebook</a></li>
 					    <li><a href="#">LinkedIn</a></li>
 					    <li><a href="#">Address</a></li> 
 					  </ul>
 			<li><form action="signout.php" method="post"><input type="submit" value="Sign out" style="display:inline-block;position:relative;float:right;"></form></li>
 			</ul>
				
 		</div>
 	</div>
 				</li>
 			</ul>
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Stack'd<p>
	</div>
	
	
<form method="post" action="buy.php">
	<div class="input-group">
	 <input list="suggestions" type="text" placeholder="Search" name="search" id="search" oninput="fetch()" class="form-control">
	<span class="input-group-btn">
        <button class="btn btn-info" type="submit">Search</button>
      </span>
</form>

	</div><!-- /input-group -->
	
	<datalist id="suggestions">
	
	</datalist>
	
</body>
 <script>
	var xhr=null;
	var suggestions=document.getElementById("suggestions");
	function fetch()
	{
		try{
			xhr=new XMLHttpRequest();
		}catch(e){
			xhr=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var term=document.getElementById('search').value;
		var url="search.php?term="+term;
		xhr.onreadystatechange=handler;
		xhr.open("GET",url,true);
		xhr.send(null);
	}
	function handler()
	{
		if(xhr.readyState==4)
		{
			if(xhr.status==200)
			{
				//to clear previous elements
				while(suggestions.firstChild)
				{
					suggestions.removeChild(suggestions.firstChild);
				}
				var response=eval("("+xhr.responseText+")");
				
				for(var key in response)
				{
					option=document.createElement('option');
					option.text=response[key];
					option.value=response[key];
					suggestions.appendChild(option);
				}	
			}
		}
	}
 </script>
</html>
