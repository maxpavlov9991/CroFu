<?php
	session_start();
	if(isset($_SESSION['logged_mail']) && isset($_SESSION['logged_password']))
	{
		if(isset($_FILES) && $_FILES['inputfile']['error'] == 0) // Проверяем, загрузил ли пользователь файл
		{
			$temp=explode('.', $_FILES['inputfile']['name']); // Отрезаем наше расширение
			$newfilename=$_SESSION['logged_mail'] . '.' . end($temp); // создаем новое имя файла + расширение

			include ("bd.php");
			$mail=$_SESSION['logged_mail'];
			$password=$_SESSION['logged_password'];
			$user_id_result=mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
			$user_id=mysqli_fetch_array($user_id_result); // для нахождения нашего id из бд
			
			$if_already_exists=mysqli_query($db,"SELECT user_id FROM customer_avatar WHERE user_id='".$user_id['id']."'");
			$if_already=mysqli_fetch_array($if_already_exists); 
			
			if($if_already==null) // проверяем есть ли уже запись о нашем пользователе в таблице customer_avatar , если нет то грузим картинку
			{
				move_uploaded_file($_FILES['inputfile']['tmp_name'], "../avatars/" . $newfilename); // Перемещаем файл в желаемую директорию
				$result_insert=mysqli_query($db,"INSERT INTO customer_avatar (user_id , file_name) VALUES ('".$user_id['id']."' , '".$newfilename."')");
			}
			else
			{
				unlink("../avatars/$newfilename");
				move_uploaded_file($_FILES['inputfile']['tmp_name'], "../avatars/" . $newfilename);
		
			}
			
			
			header('Location: myprofile.php');
			
			
		}
		else
		{
			header('Location: myprofile.php');
		}
			
	}
	else
	{
		
		header('Location: ../index.html');
	}
?>