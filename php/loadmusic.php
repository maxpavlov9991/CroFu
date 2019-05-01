<?php
	session_start();
	if(isset($_SESSION['logged_mail']) && isset($_SESSION['logged_password']))
	{

		if(isset($_FILES) && $_FILES['inputfile']['error'] == 0) // Проверяем, загрузил ли пользователь файл
		{
			
			include ("bd.php");
			$mail=$_SESSION['logged_mail'];
			$password=$_SESSION['logged_password'];
			$user_id_result=mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
			$user_id=mysqli_fetch_array($user_id_result); // для нахождения нашего id из бд
			
			$date=date("Y-m-d");
			
			$insert_at_music_info=mysqli_query($db,"INSERT INTO music_info (music_name, music_size_byte , music_date_release) VALUES ('".$_FILES['inputfile']['name']."' , '".$_FILES['inputfile']['size']."' , '".$date."')");
			
			$select_music_id=mysqli_query($db,"SELECT id FROM music_info ORDER BY id DESC LIMIT 1"); // последняя добавленная песня получаем её id из music_info;
			$music_id=mysqli_fetch_array($select_music_id);
			
			$insert_at_music_customer=mysqli_query($db, "INSERT INTO music_customer (customer_id , music_id) VALUES ('".$user_id['id']."' , '".$music_id['id']."') ");
			
			$temp=explode('.', $_FILES['inputfile']['name']); // Отрезаем наше расширение
			$newfilename=$music_id['id'] . '.' . end($temp); // создаем новое имя файла + расширение
			
			move_uploaded_file($_FILES['inputfile']['tmp_name'], "../music/" . $newfilename);
			
		}
		else
		{
			header('Location: myprofile.php');
		}
		
	}
?>