<?php

	if (isset($_POST['name']))
	{		
	$name = $_POST['name'];
	$name = trim($name); //удаляем лишние пробелы
	if ($name == '') 
	{ unset($name);} 
	}
	
	if (isset($_POST['surname'])) 
	{ 
	$surname = $_POST['surname'];
	$surname = trim($surname); //удаляем лишние пробелы
	if ($surname == '') 
	{ unset($surname);} 
	}
//заносим введенный пользователем логин в переменную $mail, если он пустой, то уничтожаем переменную
    if (isset($_POST['mail'])) 
	{ 
	$mail = $_POST['mail'];
	$mail = trim($mail);
	if ($mail == '') 
	{ unset($mail);} 
	} 
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) 
	{ 
	$password=$_POST['password'];
	$password = trim($password);
	if ($password =='') 
	{ unset($password);} 
	}


 if (empty($mail) or empty($password) or empty($name) or empty($surname)) //если пользователь не ввел данные, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
	
	
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
	$name = stripslashes($name);
    $name = htmlspecialchars($name);
	
	$surname = stripslashes($surname);
    $surname = htmlspecialchars($surname);
	
    $mail = stripslashes($mail);
    $mail = htmlspecialchars($mail);
	
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	
//подключаем бд	
	include ("bd.php");
	
//проверка на наличие данного пользователя
    $result = mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."'");
    $myrow = mysqli_fetch_array($result);
    if (!empty($myrow['id'])) 
	{
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
	

//если такого нет, то сохраняем данные
    $result2 = mysqli_query($db,"INSERT INTO customers_info (customer_name,customer_second_name,customer_email,customer_password) VALUES('".$name."','".$surname."','".$mail."','".$password."')");
	
// Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='../login.html'>Авторизация</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
	
?>