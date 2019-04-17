<?php
	session_start();
	if(isset($_SESSION['logged_mail']) && isset($_SESSION['logged_password']))
	{
	include("bd.php");
	$mail=$_SESSION['logged_mail'];
	$password=$_SESSION['logged_password'];
	
	$name1=mysqli_query($db,"SELECT customer_name FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
	$name=mysqli_fetch_array($name1);
	
	$surename1=mysqli_query($db,"SELECT customer_second_name FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
	$surename=mysqli_fetch_array($surename1);
	
	$tokens1=mysqli_query($db,"SELECT customer_tokens FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
	$tokens=mysqli_fetch_array($tokens1);
	
	//для html:
	$name_html=$name['customer_name'];
	$surename_html=$surename['customer_second_name'];
	$tokens_html=$tokens['customer_tokens'];	
	
	if($tokens_html==0)
	{
		$tokens_html=0;
	}

	
	
		echo<<<HTML
       <!DOCTYPE html>
		<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/index_style.css" rel="stylesheet">
    <title>My Profile</title>
</head>

<body>
    <header>
        <div id="logotipe" onclick="slowScroll('#myprofile')">
            <span>CROFU</span> 
        </div>
        <div id="about">
            <a href="index.php">CROFU&nbsp;MENU</a>
        </div>
    </header>

    <div id="myprofile">
	<form methhod="post" action="">
        <img id="avatar" src="../media/musician.png"><br>
        <input id="name" type="text" value="$name_html"></input><br>
        <input id="surname" type="text" value="$surename_html"></input>    
        <div id="tokens"><h4 id="tok_quan">$tokens_html</h4>
            <h4 id="token_text">Tokens</h4>
        </div>
        <button id="upload">Upload</button>
        <button id="save">Save</button>
	</form>
    </div>

<div id="myprofilemusic">
        <span>Maksex_Beatz</span>
        <audio controls>
        <source src="../music/1.mp3">
        </audio>
        <br>

        <span>Богемская Рапсодия</span>
        <audio controls>
            <source src="../music/2.mp3">
        </audio>
        <br>

        <span>SCARLORD</span>
        <audio controls>
            <source src="../music/3.mp3">
        </audio>
        <br>

        <span>ASAP ROCKY</span>
        <audio controls>
            <source src="../music/4.mp3">
        </audio>
        <br>

        <span>RSAC - NBA</span>
        <audio controls>
            <source src="../music/5.mp3">
        </audio>
        <br>

        <span>SHANGUY</span>
        <audio controls>
            <source src="../music/6.mp3">
        </audio>
        <br>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../index_script.js"></script>

</body>
</html>
HTML;
	
	}
	else
	{
		header('Location: ../login.html');
	}
	
?>