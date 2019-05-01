<?php
	
	session_start();
	if(isset($_SESSION['logged_mail']) || isset($_SESSION['logged_password']))
	{
		
		if (isset($_POST['name']) || isset($_POST['surname']))
		{		
	
		$name = $_POST['name'];
		$name = trim($name); //удаляем лишние пробелы
		if ($name == '') 
		{ unset($name);}
	
		$surname = $_POST['surname'];
		$surname = trim($surname); //удаляем лишние пробелы
		if ($surname == '') 
		{ unset($surname);} 
	
	
		include("bd.php");
		$mail=$_SESSION['logged_mail'];
		
		$name = stripslashes($name);
		$name = htmlspecialchars($name);
	
		$surname = stripslashes($surname);
		$surname = htmlspecialchars($surname);
		
		$result = mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."'");
		$myrow = mysqli_fetch_array($result);
		
		$update = mysqli_query($db, "UPDATE customers_info SET customer_name='".$name."' WHERE id='".$myrow['id']."'");
		$update2 = mysqli_query($db, "UPDATE customers_info SET customer_second_name='".$surname."' WHERE id='".$myrow['id']."'");
		
		header('Location: myprofile.php');
		
		}
		
	}
?>