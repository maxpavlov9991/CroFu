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
	
	
	$user_id_result=mysqli_query($db,"SELECT id FROM customers_info WHERE customer_email='".$mail."' AND customer_password='".$password."'");
	$user_id=mysqli_fetch_array($user_id_result);
	
	$check_if_avatar_exists=mysqli_query($db,"SELECT file_name ,user_id FROM customer_avatar WHERE user_id='".$user_id['id']."'");
	$check_if_avatar=mysqli_fetch_array($check_if_avatar_exists);
	if($check_if_avatar!=null)
	{
		$photo_name=$check_if_avatar['file_name'];
		
	}
	else
	{
		$photo_name="musician.png";
		
	}
	$date = date('m/d/Y h:i:s a', time());

	
	
		echo<<<HTML
       <!DOCTYPE html>
		<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/myprofile.css" rel="stylesheet">
    <title>My Profile</title>
</head>

<body>
	
    <header>
        <div id="hat">
            <div id="logotipe" onclick="slowScroll('#myprofile')">
                <span>CROFU</span> 
            </div>
            <div id="about">
                <a href="index.php">CROFU&nbsp;MENU</a>
            </div>
        </div>
    </header>

    <div id="content">
        <div id="myprofile">
            <div id="avatar">
                <img id="avatarimg" src="../avatars/$photo_name?$date">
            </div>
            <div id="form">
			<form method="post" action="reload_info.php">
                <input name="name" type="text" maxlength="50" size="30" value="$name_html"></input>
                <input name="surname" type="text" maxlength="50" size="30" value="$surename_html"></input>
				<button class="submit" type="submit">Save</button>
			</form>
			<form method="post" action="reload_photo.php" enctype="multipart/form-data">
                <input type="file" id="inputfile" name="inputfile" accept="image/jpeg"></input>
                <button class="submit" type="submit">Submit</button>
			</form>
            </div>
        </div>
        <div id="tokens">
            <span id="tok_quan">$tokens_html</span><br>
            <span id="token_text">Tokens</span>
        </div>
    </div>
    
    <div id="myprofilemusic">
		<div id="loadmusic">
		<form method="post" action="loadmusic.php" enctype="multipart/form-data">
			<input id="input_music" class="submit_music" type="file" id="inputfile" name="inputfile" accept=".mp3">
			<button id="save_track" class="submit_music" type="submit">Upload</button>
		</form>
		</div>
		
		
		
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