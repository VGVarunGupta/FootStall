<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.ico">
	<title>Check IN | FootStall</title>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style_signup.css">
	<link rel="stylesheet" type="text/css" href="component_login.css" />
	<script>
	function validateForm()
	{
		var x=document.forms["FORM"]["NAME"].value;
		if (x==null || x=="")
  		{
  			document.getElementById("err").innerHTML = "*Name Required"; 
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		
		x=document.forms["FORM"]["EMAIL"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			document.getElementById("err").innerHTML = "*Email address invalid";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
	}
	</script>
</head>
<body id="canvas">
	<p align = center>
	<img src = "../images/logo.png" id = "logo" width = 200px style="margin-top:-20px;"></p>
	<p id = "err" class = "error" align = center>&nbsp;
	<?php
	if(isset($_SESSION['dis']))
	{
	echo $_SESSION['dis'];
	unset($_SESSION["final"]);
	}
	?>
	</p>
	<div style="margin-left:auto; margin-right:auto; position: relative;">
		<form name = "FORM" action = "feedinser.php" method = "POST" style="background: rgba(0, 0, 0, 0.9);width: 49%;margin-left:auto; margin-right:auto;margin-top: 20px;padding: 20px; border: 2px solid #27A308;">
			<p align=center style="color: #27a308;text-shadow: 2px 2px 2px #000;font-size: x-large; font-weight: bold;">FEEDBACK FORM</p> 
		<?php 
			if($_SESSION["log"]==1)
			{
		?>
			<div id = "blank_field">
				<div id = "blank_label">
					<div class = "label">Name :</div>
					<div class = "label" style="margin-top:55px;">Email :</div>
					<div class = "label">Feedback : </div>
				</div>
				<input type = "text" name = "NAME" class = "field" id = "NAME" value=<?php echo $_SESSION['name'];?>><br/>
				<div class = "hrule"><hr size = 1px></div>
				<input type = "text" name = "EMAIL" class="field" id = "EMAIL" value=<?php echo $_SESSION['email'];?>><br/>
				<textarea  rows="10" cols="45" type = "text" name = "FEEDBACK" class="field1" id = "FEEDBACK"> </textarea><br/>
				<button class="btn btn-7 btn-7h icon-envelope" name = "FINISH" value = "submit" onclick = "return validateForm()">Submit form</button>
			</div>
			<?php
			}
			else
			{
			?>
			<div id = "blank_field">
				<div id = "blank_label">
					<div class = "label">Name : &nbsp;&nbsp;</div>
					<div class = "label" style="margin-top:55px;">Email : &nbsp;&nbsp;</div>
					<div class = "label">Feedback : &nbsp;&nbsp;</div>
				</div>
				<input type = "text" name = "NAME" class = "field" id = "NAME"><br/>
				<div class = "hrule"><hr size = 1px></div>
				<input type = "text" name = "EMAIL" class="field" id = "EMAIL"><br/>
				<textarea  rows="10" cols="45" type = "text" name = "FEEDBACK" class="field1" id = "FEEDBACK"> </textarea><br/>
				<button class="btn btn-7 btn-7h icon-envelope" name = "FINISH" value = "submit" onclick = "return validateForm()">Submit form</button>
			</div>
			<?php
			}
			?>
		</form>

	</div>
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>
</body>
<?php 
session_destroy();
?>
</html>