<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.ico">
	<title>Check IN | FootStall</title>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style_signup.css">
	<link rel="stylesheet" type="text/css" href="css/component_login.css" />
	<script src="js/modernizr.custom_login.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">

      document.addEventListener("DOMContentLoaded", init, false);

      function init()
      {
        var canvas = document.getElementById("canvas");
        canvas.addEventListener("mousedown", getPosition, false);
      }

      function getPosition(event)
      {
        var x = new Number();
        var y = new Number();
        var canvas = document.getElementById("canvas");

        if (event.x != undefined && event.y != undefined)
        {
          x = event.x;
          y = event.y;
        }
        else // Firefox method to get the position
        {
          x = event.clientX + document.body.scrollLeft +
              document.documentElement.scrollLeft;
          y = event.clientY + document.body.scrollTop +
              document.documentElement.scrollTop;
        }

        x -= canvas.offsetLeft;
        y -= canvas.offsetTop;
        if ((x<342 || x>1024) || (y<242 || y>448) && document.getElementById("mailver").style.visibility == "visible")
        {
             document.getElementById("mailver").style.visibility = "hidden";
             document.getElementById("blank_field").style.zIndex = "1";
			 document.getElementById("mailver").style.zIndex = "-1";
             document.getElementById("blank_field").style.opacity = "1";
             document.getElementById("logo").style.opacity = "1";
        }
		if ((x<451 || x>915) && document.getElementById("wrapper").style.display == "block")
        {
             document.getElementById("wrapper").style.display = "none";
             document.getElementById("blank_field").style.zIndex = "1";
			 document.getElementById("wrapper").style.zIndex = "-1";
             document.getElementById("blank_field").style.opacity = "1";
             document.getElementById("logo").style.opacity = "1";
        }
      }

    </script>	
    <script>
	function show()  {
    	document.getElementById("blank_field").style.opacity = "0.25";
    	document.getElementById("logo").style.opacity = "0.25";
    	document.getElementById("mailver").style.visibility = "visible";
    	document.getElementById("blank_field").style.zIndex = "-1";
    	document.getElementById("mailver").style.zIndex = "1";
	}
	function show1()  {
    	document.getElementById("blank_field").style.opacity = "0";
    	document.getElementById("logo").style.opacity = "0";
    	document.getElementById("blank_field").style.zIndex = "-1";
    	document.getElementById("wrapper").style.zIndex = "1";
		document.getElementById("wrapper").style.display = "block";
	}
    </script>
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
		
		x=document.forms["FORM"]["MONTH"].value;
		x=x.concat("/",document.forms["FORM"]["DATE"].value,"/",document.forms["FORM"]["YEAR"].value);
		var monthfield=x.split("/")[0];
		var dayfield=x.split("/")[1];
		var yearfield=x.split("/")[2];
		var dayobj = new Date(yearfield, monthfield-1, dayfield);
		if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
		{
			document.getElementById("err").innerHTML = "*Invalid Date of Birth";
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
		x=document.forms["FORM"]["PASSWORD"].value;
		y=document.forms["FORM"]["REPASS"].value;
		if (x.length<=6)
		{
			document.getElementById("err").innerHTML = "*Password length should be more than 6 characters";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
			return false;
		}
		else if (x!=y)
		{
			document.getElementById("err").innerHTML = "*Passwords do not match";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
			return false;
		}
	}
	function valid()
	{
		var x=document.forms["form"]["NAME"].value;
		var y=document.forms["form"]["EMAIL"].value;
		var z=document.forms["form"]["ENTRY"].value;
		var atpos=y.indexOf("@");
		var dotpos=y.lastIndexOf(".");
		if (x=="" || y=="" || z=="")
		{
			document.getElementById("err1").innerHTML = "*All fields required";
			setTimeout(function(){document.getElementById("err1").innerHTML = "&nbsp;"}, 4000);
			return false;
		}
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=y.length)
		{
			document.getElementById("err1").innerHTML = "*Email address invalid";
			setTimeout(function(){document.getElementById("err1").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		document.getElementById("err1").innerHTML = "Thanks! Your entry has been recorded.";
		document.getElementById("err1").color = "#5491ae";
		setTimeout(function(){document.getElementById("err1").innerHTML = "&nbsp;"}, 8000);	
	}
	function validateForm2()
	{
		var x;
		x=document.forms["SIGNIN"]["EMAIL2"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			document.getElementById("err").innerHTML = "*Email address invalid";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
  			return false;
  		}
		x=document.forms["SIGNIN"]["PASSWORD2"].value;
		if (x.length<=6)
		{
			document.getElementById("err").innerHTML = "Incorrect Password";
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
	<?php
	if(isset($_SESSION["final"]))
	{
		if($_SESSION["final"]==1) {
	?>
			<script>
			document.getElementById("err").innerHTML = "*Email already exists";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
			return false;
			</script>
	<?php
		}
		unset($_SESSION["final"]);
	} 
	if(isset($_SESSION["flag"]))  
	{
		if($_SESSION["flag"]==0) {
	?>
			<script>
				document.getElementById("err").innerHTML = "*Registration Successful. Verification email sent.";
				setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 5000);
				return false;
			</script>
			<script type = "text/javascript" src = "dialog.js"></script>
	<?php
		}
	}
	unset($_SESSION["flag"]);  
	?>	
	<?php
	if(isset($_SESSION["log"]))
	{
		if($_SESSION["log"]==0) {
	?>
			<script>
			document.getElementById("err").innerHTML = "*Incorrect UserID or Password";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
			</script>
	<?php
		}
		else if($_SESSION["log"]==2) {
	?>
			<script>
			document.getElementById("err").innerHTML = "*Your account has not been verified yet. Please verify it first.";
			setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
			</script>
	<?php
		}
	}
	unset($_SESSION["log"]);
	?>
	<div style="margin-left:auto; margin-right:auto; position: relative;">
		<form name = "FORM" action = "insert.php" method = "POST" style="float: left;background: rgba(0, 0, 0, 0.9);width: 49%;margin-left: 70px;margin-top: 20px;padding: 20px; border: 2px solid #27A308;">
			<p align=center style="color: #27a308;text-shadow: 2px 2px 2px #000;font-size: x-large; font-weight: bold;">SIGN UP</p> 
			<div id = "blank_field">
				<div id = "blank_label">
					<div class = "label">Name : &nbsp;&nbsp;</div>
					<div class = "label">Date of Birth : &nbsp;&nbsp;</div>
					<div class = "label" style="margin-top:55px;">Email : &nbsp;&nbsp;</div>
					<div class = "label">Password : &nbsp;&nbsp;</div>
					<div class = "label">Retype Password : &nbsp;&nbsp;</div>
				</div>
				<input type = "text" name = "NAME" class = "field" id = "NAME"><br/>
				<select name="DATE" size="1" class="date" id = "DATE" \>
						<option class = "bck" value = "1">1</option>
						<option class = "bck" value = "2">2</option>
						<option class = "bck" value = "3">3</option>
						<option class = "bck" value = "4">4</option>
						<option class = "bck" value = "5">5</option>
						<option class = "bck" value = "6">6</option>	
						<option class = "bck" value = "7">7</option>
						<option class = "bck" value = "8">8</option>
						<option class = "bck" value = "9">9</option>
						<option class = "bck" value = "10">10</option>
						<option class = "bck" value = "11">11</option>
						<option class = "bck" value = "12">12</option>
						<option class = "bck" value = "13">13</option>
						<option class = "bck" value = "14">14</option>
						<option class = "bck" value = "15">15</option>
						<option class = "bck" value = "16">16</option>
						<option class = "bck" value = "17">17</option>
						<option class = "bck" value = "18">18</option>
						<option class = "bck" value = "19">19</option>
						<option class = "bck" value = "20">20</option>
						<option class = "bck" value = "21">21</option>
						<option class = "bck" value = "22">22</option>
						<option class = "bck" value = "23">23</option>
						<option class = "bck" value = "24">24</option>
						<option class = "bck" value = "25">25</option>
						<option class = "bck" value = "26">26</option>
						<option class = "bck" value = "27">27</option>
						<option class = "bck" value = "28">28</option>
						<option class = "bck" value = "29">29</option>
						<option class = "bck" value = "30">30</option>
						<option class = "bck" value = "31">31</option>
					</select>
					<select name="MONTH" size="1" class="month" id = "MONTH">
						<option class = "bck" value = "1">January</option>
						<option class = "bck" value = "2">February</option>
						<option class = "bck" value = "3">March</option>
						<option class = "bck" value = "4">April</option>
						<option class = "bck" value = "5">May</option>
						<option class = "bck" value = "6">June</option>
						<option class = "bck" value = "7">July</option>
						<option class = "bck" value = "8">August</option>
						<option class = "bck" value = "9">September</option>
						<option class = "bck" value = "10">October</option>
						<option class = "bck" value = "11">November</option>
						<option class = "bck" value = "12">December</option>
					</select>
					<select name="YEAR" size="1" class="year" id = "YEAR">
						<option class = "bck" value = "2013">2013</option>
						<option class = "bck" value = "2012">2012</option>
						<option class = "bck" value = "2011">2011</option>
						<option class = "bck" value = "2010">2010</option>
						<option class = "bck" value = "2009">2009</option>
						<option class = "bck" value = "2008">2008</option>
						<option class = "bck" value = "2007">2007</option>
						<option class = "bck" value = "2006">2006</option>
						<option class = "bck" value = "2005">2005</option>
						<option class = "bck" value = "2004">2004</option>
						<option class = "bck" value = "2003">2003</option>
						<option class = "bck" value = "2002">2002</option>
						<option class = "bck" value = "2001">2001</option>
						<option class = "bck" value = "2000">2000</option>
						<option class = "bck" value = "1999">1999</option>
						<option class = "bck" value = "1998">1998</option>
						<option class = "bck" value = "1997">1997</option>
						<option class = "bck" value = "1996">1996</option>
						<option class = "bck" value = "1995">1995</option>
						<option class = "bck" value = "1994">1994</option>
						<option class = "bck" value = "1993">1993</option>
						<option class = "bck" value = "1992">1992</option>
						<option class = "bck" value = "1991">1991</option>
						<option class = "bck" value = "1990">1990</option>
						<option class = "bck" value = "1989">1989</option>
						<option class = "bck" value = "1988">1988</option>
						<option class = "bck" value = "1987">1987</option>
						<option class = "bck" value = "1986">1986</option>
						<option class = "bck" value = "1985">1985</option>
						<option class = "bck" value = "1984">1984</option>
						<option class = "bck" value = "1983">1983</option>
						<option class = "bck" value = "1982">1982</option>
						<option class = "bck" value = "1981">1981</option>
						<option class = "bck" value = "1980">1980</option>
						<option class = "bck" value = "1979">1979</option>
						<option class = "bck" value = "1978">1978</option>
						<option class = "bck" value = "1977">1977</option>
						<option class = "bck" value = "1976">1976</option>
						<option class = "bck" value = "1975">1975</option>
						<option class = "bck" value = "1974">1974</option>
						<option class = "bck" value = "1973">1973</option>
						<option class = "bck" value = "1972">1972</option>
						<option class = "bck" value = "1971">1971</option>
						<option class = "bck" value = "1970">1970</option>
						<option class = "bck" value = "1969">1969</option>
						<option class = "bck" value = "1968">1968</option>
						<option class = "bck" value = "1967">1967</option>
						<option class = "bck" value = "1966">1966</option>
						<option class = "bck" value = "1965">1965</option>
						<option class = "bck" value = "1964">1964</option>
						<option class = "bck" value = "1963">1963</option>
						<option class = "bck" value = "1962">1962</option>
						<option class = "bck" value = "1961">1961</option>
						<option class = "bck" value = "1960">1960</option>
						<option class = "bck" value = "1959">1959</option>
						<option class = "bck" value = "1958">1958</option>
						<option class = "bck" value = "1957">1957</option>
						<option class = "bck" value = "1956">1956</option>
						<option class = "bck" value = "1955">1955</option>
						<option class = "bck" value = "1954">1954</option>
						<option class = "bck" value = "1953">1953</option>
						<option class = "bck" value = "1952">1952</option>
						<option class = "bck" value = "1951">1951</option>
						<option class = "bck" value = "1950">1950</option>
						<option class = "bck" value = "1949">1949</option>
						<option class = "bck" value = "1948">1948</option>
						<option class = "bck" value = "1947">1947</option>
						<option class = "bck" value = "1946">1946</option>
						<option class = "bck" value = "1945">1945</option>
						<option class = "bck" value = "1944">1944</option>
						<option class = "bck" value = "1943">1943</option>
						<option class = "bck" value = "1942">1942</option>
						<option class = "bck" value = "1941">1941</option>
						<option class = "bck" value = "1940">1940</option>
						<option class = "bck" value = "1939">1939</option>
						<option class = "bck" value = "1938">1938</option>
						<option class = "bck" value = "1937">1937</option>
						<option class = "bck" value = "1936">1936</option>
						<option class = "bck" value = "1935">1935</option>
						<option class = "bck" value = "1934">1934</option>
						<option class = "bck" value = "1933">1933</option>
						<option class = "bck" value = "1932">1932</option>
						<option class = "bck" value = "1931">1931</option>
						<option class = "bck" value = "1930">1930</option>
						<option class = "bck" value = "1929">1929</option>
						<option class = "bck" value = "1928">1928</option>
						<option class = "bck" value = "1927">1927</option>
						<option class = "bck" value = "1926">1926</option>
						<option class = "bck" value = "1925">1925</option>
						<option class = "bck" value = "1924">1924</option>
						<option class = "bck" value = "1923">1923</option>
						<option class = "bck" value = "1922">1922</option>
						<option class = "bck" value = "1921">1921</option>
						<option class = "bck" value = "1920">1920</option>
						<option class = "bck" value = "1919">1919</option>
						<option class = "bck" value = "1918">1918</option>
						<option class = "bck" value = "1917">1917</option>
						<option class = "bck" value = "1916">1916</option>
						<option class = "bck" value = "1915">1915</option>
						<option class = "bck" value = "1914">1914</option>
						<option class = "bck" value = "1913">1913</option>
						<option class = "bck" value = "1912">1912</option>
						<option class = "bck" value = "1911">1911</option>
						<option class = "bck" value = "1910">1910</option>
						<option class = "bck" value = "1909">1909</option>
						<option class = "bck" value = "1908">1908</option>
						<option class = "bck" value = "1907">1907</option>
						<option class = "bck" value = "1906">1906</option>
						<option class = "bck" value = "1905">1905</option>
						<option class = "bck" value = "1904">1904</option>
						<option class = "bck" value = "1903">1903</option>
						<option class = "bck" value = "1902">1902</option>
						<option class = "bck" value = "1901">1901</option>
						<option class = "bck" value = "1900">1900</option>
					</select><br/>
				<div class = "hrule"><hr size = 1px></div>
				<input type = "text" name = "EMAIL" class="field" id = "EMAIL"><br/>
				<input type = "password" name = "PASSWORD" class="field" id = "PASSWORD"><br/>
				<input type = "password" name = "REPASS" class="field" id = "REPASS"><br/>
				<button class="btn btn-7 btn-7h icon-envelope" name = "FINISH" value = "submit" onclick = "return validateForm()">Submit form</button>
			</div>
		</form>
		<form name = "SIGNIN" action = "check.php" method = "POST" style="float: left;background: rgba(0, 0, 0, 0.9);margin-top: 20px;padding: 110px; border: 2px solid #27A308;">
			<p align=center style="font-size: x-large; font-weight: bold; color: #27a308; text-shadow: 2px 2px 2px #000; margin-top: -63px">SIGN IN</p> 
			<div id = "blank_field" style="margin-top: 85px;margin-bottom: 27px;">
				<div id = "blank_label">
					<div class = "label">Email : &nbsp;&nbsp;</div>
					<div class = "label">Password : &nbsp;&nbsp;</div>
				</div>
			<input type = "text" name = "EMAIL2" class="field" id = "EMAIL2"><br/>
			<input type = "password" name = "PASSWORD2" class="field" id = "PASSWORD2"><br/>
			<button class="btn btn-7 btn-7h icon-envelope" name = "FINISH" value = "submit" onclick = "return validateForm2()">Submit form</button>
			</div>
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