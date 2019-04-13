<?php
	 
    if (isset($_POST['mail'])) 
	{ 
	$mail = $_POST['mail'];
	$mail = trim($mail);
	if ($mail == '') 
	{ unset($mail);} 
	}
	
    if (isset($_POST['password'])) 
	{ 
	$password=$_POST['password'];
	$password = trim($password);
	if ($password =='') 
	{ unset($password);} 
	}
	
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
	if (empty($mail) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Введите пароль и почту!");
    }
	
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $mail = stripslashes($mail);
    $mail = htmlspecialchars($mail);
	
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	
	
//подключаем бд	
	include ("bd.php");
	
//проверка на наличие данного пользователя
	$result = mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['id'])) 
	{
    exit ("Вы ввели неверную почту или пароль");
    }
	else
	{
		$_SESSION['logged_mail']=$mail;
		$_SESSION['logged_passowrd']=$password;
		echo "Вы успешно авторизованны! Теперь вы можете зайти на сайт. <a href='../index.html'>Главная страница</a>";
		
	}
	
?>
	