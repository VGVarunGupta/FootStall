<?php 
session_start();
if (isset($_SESSION['log']))
{
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../favicon.ico">
	<title>FootStall | More About you</title>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style_signup.css">
	<link rel="stylesheet" type="text/css" href="css/component_login.css" />
	<script src="js/modernizr.custom_login.js"></script>
	<script>
	function validateForm()
	{
		var x=document.forms["FORM"]["FAVT1"].value;
		if (x=="1")
  		{
  			document.getElementById("err").innerHTML = "*Field required"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		var x=document.forms["FORM"]["FAVT2"].value;
		if (x=="1")
  		{
  			document.getElementById("err").innerHTML = "*Field required"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		var x=document.forms["FORM"]["FAVL"].value;
		if (x=="1")
  		{
  			document.getElementById("err").innerHTML = "*Field required"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		var x=document.forms["FORM"]["FAVC"].value;
		if (x=="1")
  		{
  			document.getElementById("err").innerHTML = "*Field required"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		var x=document.forms["FORM"]["FAVT1"].value;
		var y=document.forms["FORM"]["FAVT2"].value;
		if (x==y)
  		{
  			document.getElementById("err").innerHTML = "*Favourites cannot be same"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
	}
	</script>
</head>
<body id="canvas">
	<p align = center>
	<img src = "images/logo.png" id = "logo" width = 200px style="margin-top:-20px;"></p>
	<p id = "err" class = "error" align = center>&nbsp;</p>
	<div style="margin-left:auto; margin-right:auto; position: relative;">
		<form name = "FORM" action = "favinser.php" method = "POST" style="background: rgba(0, 0, 0, 0.9);width: 49%;margin-left:auto; margin-right:auto;margin-top: 20px;padding: 20px; border: 2px solid #27A308;">
			<h1 style="text-align:center; color: #0097DF;">WELCOME TO FOOTSTALL</h1>
			<p align=center style="color: #27a308;text-shadow: 2px 2px 2px #000;font-size: x-large; font-weight: bold;">Tell us more about you</p> 
			<div id = "blank_field">
				<div id = "blank_label">
					<div class = "label">Favourite Team-1 : &nbsp;&nbsp;</div>
					<div class = "label" >Favourite Team-2 : &nbsp;&nbsp;</div>
					<div class = "label" >Favourite League : &nbsp;&nbsp;</div>
					<div class = "label">Favourite Country : &nbsp;&nbsp;</div>
				</div>
				<select name="FAVT1" size="1" class="fav" id = "favt1" \>
				<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "1">Select a Team</option>
					<optgroup label="La Liga">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL1">FC Barcelona</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL3">Real Madrid</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL11">Valencia</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL2">Athletico Madrid</option>
					</optgroup>
					<optgroup label="English Premier League">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL1">Arsenal</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL3">Chelsea</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL7">Manchester United</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL2">Manchester City</option>	
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL5">LiverPool</option>	
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL6">Tottenham Hotspur</option>	
					</optgroup>
					<optgroup label="Bundesliga">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN1">Bayern Munich</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN4">Borussia Dortmund</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN7">FC Schalke 04</option>
					</optgroup>
					<optgroup label="Serie-A">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SR1">Juventus</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER3">Napoli</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER5">Internazionale</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER13">AC Milan</option>
					</optgroup>
				</select>
				<select name="FAVT2" size="1" class="fav" id = "favt1" \>
				<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "1">Select a Team</option>
					<optgroup label="La Liga">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL1">FC Barcelona</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL3">Real Madrid</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL11">Valencia</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL2">Athletico Madrid</option>
					</optgroup>
					<optgroup label="English Premier League">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL1">Arsenal</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL3">Chelsea</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL7">Manchester United</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL2">Manchester City</option>	
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL5">LiverPool</option>	
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL6">Tottenham Hotspur</option>	
					</optgroup>
					<optgroup label="Bundesliga">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN1">Bayern Munich</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN4">Borussia Dortmund</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN7">FC Schalke 04</option>
					</optgroup>
					<optgroup label="Serie-A">
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SR1">Juventus</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER3">Napoli</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER5">Internazionale</option>
						<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER13">AC Milan</option>
					</optgroup>
				</select>
				<select name="FAVL" size="1" class="fav" id = "favl" \>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "1">Select a League</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SPL">La Liga</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "EPL">English Premier League</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BUN">Bundesliga</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "SER">Serie-A</option>
				</select>
				<select name="FAVC" class="fav" id = "favc" \>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "1">Select a Country</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "ESP">Spain</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "ENG">England</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "GER">Germany</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "ITA">Italy</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "BRA">Brazil</option>
					<option class = "fav" style="background: rgba(0,0,0,0.9);" value = "ARG">Argentina</option>
				</select>
				<button class="btn btn-7 btn-7h icon-envelope" name = "FINISH" value = "submit" onclick="return validateForm()">Submit</button>
			</div>
		</form>
	</div>
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>
</body>
<?php
}
?>
</html>