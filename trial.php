<?php
session_start();
//upload page
	if(isset($_POST['submit']))
	{
		//echo "paras";
		$isbn=(!empty($_POST['isbn'])?$_POST['isbn']:'none');
		$bname=$_POST['bname'];
		$author=$_POST['author'];
		$subject=(!empty($_POST['publisher'])?$_POST['publisher']:'none');
		$edition=(!empty($_POST['edition'])?$_POST['edition']:1);
		$rent=$_POST['rent'];
		$sell=$_POST['sell'];
		$new_file_name1='none';
		$new_file_name2='none';
		$file_name1='none';
		$file_name2='none';
		$random1=null;
		$random2=null;
		
		
		//uploading file
		if(is_uploaded_file($_FILES['upload1']['tmp_name']))
		{
			//echo "<br>file1";
			//renaming
			$file_name1=$_FILES['upload1']['name'];
			$random1=rand(000,999);
			$new_file_name1=$random1.$file_name1;
			
			
			if(move_uploaded_file($_FILES['upload1']['tmp_name'],"book_images/{$new_file_name1}"))
			{
					echo $new_file_name1;
			}
			else
			error($_FILES['upload1']['error']);
			
		}
		if(is_uploaded_file($_FILES['upload2']['tmp_name']))
		{
			//echo "<br>file2";
			$file_name2=$_FILES['upload2']['name'];
			$random2=rand(000,999);
			$new_file_name2=$random2.$file_name2;
			
			
			if(move_uploaded_file($_FILES['upload2']['tmp_name'],"notes/{$new_file_name2}"))
			{
					echo $new_file_name2;
			}
			else
			error($_FILES['upload2']['error']);
			
		}
		
		//connecting to db
		$db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","server");
			$insert=$db->prepare("INSERT INTO `book_sharing`.`books` (`db_user_id`, `isbn`, `book_name`, `author`, `subject`, `edition`,`rent`,`sell`, `note_one`,`note_one_path`, `note_two`,`note_two_path`) VALUES ('{$_SESSION['db_user_id']}', '{$isbn}', '{$bname}', '{$author}', '{$subject}', '{$edition}','{$rent}','{$sell}', '{$file_name1}','{$random1}', '{$file_name2}','{$random2}');");
			$insert->execute();	
		$db=null;
		
		
		echo "<br><br>";
		//print_r($_POST);
		//reporting error for file upload
		function error($error_code)
		{
			switch($error_code)
			{
				case 1:echo "<br>File size greater than system allows";break;
				case 2:echo "<br>file greater than form allows";break;
				case 3:echo "<br>Only a part of the file was uploaded";break;
				case 4:echo "<br>No file upload";
			}
		}
	}
	

?>
<!DOCTYPE HTML>
<html>

<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Add a book</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
			<link type="text/css" rel="stylesheet" href="trial.css">
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
 				<li><form action="signout.php" method="post"><input type="submit" value="Sign out" style="display:inline-block;position:relative;float:right;"></form></li>
 			</ul>
 		</div>
 	</div>
	
	<div class="header">
		<p id="heading_top">Stack'd<p>
	</div>
	
<p id="head1">Add a book to your Bookshelf</p>

		
			<form method="post" class="block form-horizontal" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="number" name="isbn" id="isbn" align="middle" class="box" placeholder="ISBN" list="suggestions" oninput="fetch()" autocomplete="off"><br>
					<input type="text" name="bname" class="box" placeholder="Book Name" required><br>
					<input type="text" name="author" class="box" placeholder="Author" required><br>
					<input type="text" name="edition" class="box" placeholder="Edition"><br>
					<input type="text" name="publisher" class="box" placeholder="Publisher"><br>
					<input type="number" name="rent" class="box" placeholder="Rent at &#8377;" min="0"><br>
					<input type="number" name="sell" class="box" placeholder="Sell At &#8377;" min="0"><br>
					<input type="hidden" name="MAX_FILE_SIZE" value="9000000">
					<input type="file" class="upload" name="upload1" style="display:inline-block;"> Upload an image<br>
					<input type="hidden" name="MAX_FILE_SIZE" value="9000000">
					<input type="file" class="upload" name="upload2" style="display:inline-block;"> Upload the notes<br>
					<!--
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input style="text-align:center, vertical-align:middle" type="checkbox" id="inlineCheckbox1" name="Sell" class="check_box" value="Sell"><strong>Add to Sell</strong><br>
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="Rent" class="check_box" id="inlineCheckbox2" value="Rent"><strong>Add to Rent Out</strong><br>
					-->
					<div style="width:100%;height:100%;position:absolute;vertical-align:middle;text-align:center; margin-bottom:0px">
					    <button name="submit" value="submit" type="submit" class="btn btn-primary" style="margin-left:auto;margin-right:auto;display:block;margin-top:1em;margin-bottom:0em">Submit</button> 
					</div>​
			</form>
			<datalist id="suggestions">
	
			</datalist>
	
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>

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
		var term=document.getElementById('isbn').value;
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
</body>
