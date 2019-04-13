<?php
	$username = "root";
	$passwordbd = "qetuo13579";
	$hostname = "localhost";
	$bdname = "Customers";
	$db = mysqli_connect($hostname,$username,$passwordbd);
    mysqli_select_db($db,"Customers");
?>