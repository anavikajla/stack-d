<?php
session_start();
 if(!isset($_SESSION['db_user_id']))
 {
	header('Location: login_page.php');
	exit;
 }	


	//to search within the user's db + universal search
	header("Content-type:application/json");
	
	$term=$_GET['term'];
	$db=new PDO("mysql:host=localhost;dbname=book_sharing;","root","server");
	
	//to fetch books
	$select=$db->prepare("SELECT `book_name` FROM books WHERE `book_name` LIKE '{$term}%';");
	$select->execute();
	$results=$select->fetchAll();	
	
	//to fetch authors
	$auth=$db->prepare("SELECT `author` FROM books WHERE `author` LIKE '{$term}%';");
	$auth->execute();
	$authors=$auth->fetchAll();	
	
	
	//to fetch ISBN
	$isbn=$db->prepare("SELECT `isbn` FROM books WHERE `isbn` LIKE '{$term}%';");
	$isbn->execute();
	$allisbn=$isbn->fetchAll();	
	
	//for books
	$i=0;
		foreach($results as $result)
			{
				$response[$i]=$result;
				$i++;
			}
	//for authors
	$i=0;
		foreach($authors as $result)
			{
				$bauthors[$i]=$result;
				$i++;
			}
	//for isbn
	$i=0;
		foreach($allisbn as $result)
			{
				$aisbn[$i]=$result;
				$i++;
			}	
	$db=null;
	print("{");
			echo "abc:''";
			//for books
			if(isset($response[0]))
			echo ",bone:'{$response[0]['book_name']}'";
			
			if(isset($response[1]))
			echo ",btwo:'{$response[1]['book_name']}'";
			
			if(isset($response[2]))
			echo ",bthree:'{$response[2]['book_name']}'";
			/*
			if(isset($response[3]))
			echo ",bfour:'{$response[3]['book_name']}'";
			
			if(isset($response[4]))
			echo ",bfive:'{$response[4]['book_name']}'";
			*/
			//for authors
			if(isset($bauthors[0]))
			echo ",aone:'{$bauthors[0]['author']}'";
			
			if(isset($bauthors[1]))
			echo ",atwo:'{$bauthors[1]['author']}'";
			
			if(isset($bauthors[2]))
			echo ",athree:'{$bauthors[2]['author']}'";
			
			//for isbn
			if(isset($aisbn[0]))
			echo ",ione:'{$aisbn[0]['isbn']}'";
			
			if(isset($aisbn[1]))
			echo ",itwo:'{$aisbn[1]['isbn']}'";
			
			if(isset($aisbn[2]))
			echo ",ithree:'{$aisbn[2]['isbn']}'";
	print("}");
	//print_r($response);
?>
