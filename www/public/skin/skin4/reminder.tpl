<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>eCamp v2</title>
		
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
        <link rel="stylesheet" type="text/css" href="./public/global/css/global.css" />       
        
        <link rel="stylesheet" type="text/css" href="./public/skin/skin3/css/main.css" />
        <link rel="stylesheet" type="text/css" href="./public/skin/skin3/css/color.css" />
        <link rel="stylesheet" type="text/css" href="./public/skin/skin3/css/layout.css" />
        
        
        <style>
        	table
			{ 	font-size:13px;}	
			font.title
			{	font-size: 25px;	}
        	
        	.message, .login, .register
			{
				width:380px;
				padding:30px 10px 10px 10px;
				margin-bottom:20px;
			}
			
			input[type=text], input[type=password]
			{
				width: 100%;
			}
			
			div.login
			{
				position: relative;
			}
			
			div.gotologin
			{
				position: absolute;
				top: 2px;
				right: 4px;
			}
        </style>
        
        	
		<script type="text/javascript" language="javascript" src="./public/global/js/mootools1.2.js"></script>
	</head>
	
	
	<body marginheight="100" marginwidth="0" class="bgcolor ">
		<center>	
			<div class="message bgcolor_content content_border_fit" tal:condition="SHOW_MSG" >
	        	<span tal:content="MSG">TEXT...</span>
	        </div>
			
			<div class="login bgcolor_content content_border_fit">
				<div class="gotologin">
					<a href="login.php">Zurück zum Login</a>
				</div>
	        	<form action="reminder_do.php" method="post">
	                <table width="80%">
	                    <tr><td colspan="2"><font class="title">eCamp - Reminder</font></td></tr>
	                    <tr height="10"><td> </td></tr>
	                    <tr>
	                    	<td colspan="2">
	                    		Wenn du dein Passwort vergessen hast, kannst du hier deine eMail - Adresse eintragen.
	                    		Du erhälst eine Mail mit einem Link, um dir ein neues Passwort zu setzten.
	                    	</td>
	                    </tr>
	                    <tr height="10"><td> </td></tr>
	                    
	                    <tr><td>E-Mail:</td><td><input tabindex="1" name="Login" type="text" /></td></tr>
	                    <tr height="10"><td> </td></tr>
	                    
	                    <tr><td colspan="2">
	                    		<tal:block content="structure captcha" />
	                    </td></tr>
	                    
	                    <tr><td colspan="2" align="right"><input tabindex="7" type="submit" value="Abschicken" /></td></tr>
	                    <tr><td> </td></tr>
	                    
	                </table>
	            </form>
	        </div>
		</center>
	</body>
</html>
