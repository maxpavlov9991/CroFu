<?php
	$username = "root";
	$passwordbd = "password";
	$hostname = "hostname";
	$bdname = "Customers";
	$db = mysqli_connect($hostname,$username,$passwordbd);
    mysqli_select_db($db,"Customers");
?>