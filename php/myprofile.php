<?php
	session_start();
	if(isset($_SESSION['logged_mail']) && isset($_SESSION['logged_passowrd']))
	{
		echo<<<HTML
		<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/index_style.css" rel="stylesheet">
    <title>CroFu</title>
</head>
<body>
    <header>
        <div id="logotipe" onclick="slowScroll('#top')">
            <span>CROFU</span> 
        </div>
        <div id="about">
			<a href="myprofile.php">MY&nbsp;PROFILE</a>
            <a href="logout.php">LOG&nbsp;OUT</a>
        </div>
    </header>
	
	
<div id="name">
	<p>
	<h5>Name:<br></h5>
	YourName: <output name="Govno"></output>
	</p>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../index_script.js"></script>
</body>
</html>
HTML;
		
	}
?>