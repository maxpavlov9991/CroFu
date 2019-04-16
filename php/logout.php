<?php
	session_start();
	unset($_SESSION['logged_mail']);
	unset($_SESSION['logged_password']);
	header('Location: ../index.html');
?>