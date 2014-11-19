<?php 
include('../Db_info.php');
session_start();
$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
mysql_select_db($db_name)or die("Cannot Select the database");
$sql=mysql_query("Select * from epl_fixture where status=0 Order by date");
$i=1;
while($row=mysql_fetch_array($sql))
{
	$eht[$i]=$row['home'];
	$eat[$i]=$row['away'];
	$array=explode(" ",$row['date']);
	$edate[$i]=$array[0];
	$etime[$i]=$array[1];
	$i+=1;
}
$sql=mysql_query("Select * from ucl_fixture where status=0 Order by date");
$j=1;
while($row=mysql_fetch_array($sql))
{
	$ucht[$j]=$row['home'];
	$ucat[$j]=$row['away'];
	$array=explode(" ",$row['date']);
	$ucdate[$j]=$array[0];
	$uctime[$j]=$array[1];
	$j+=1;
}
$sql=mysql_query("Select * from uel_fixture where status=0 Order by date");
$k=1;
while($row=mysql_fetch_array($sql))
{
	$ht[$k]=$row['home'];
	$at[$k]=$row['away'];
	$array=explode(" ",$row['date']);
	$date[$k]=$array[0];
	$time[$k]=$array[1];
	$k+=1;
}
?>
<html>

<head>
	<title>FootStall - Upcoming Matches</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="../js/jquery-2.0.3.js"></script>
	<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		$(window).scroll(function ()
		{
			var dynamicContentId = "DynamicDiv";
        
			if(($(window).scrollTop()) >= 100) {
				$("#dash").css("position", "fixed");
				$("#dash").css("top", "0");
				$("#dash").css("width", "100%");
				$("#logo").css("display", "none");
				if ($("#" + dynamicContentId).length == 0) {
					$("#subs").prepend("<li id=\"" + dynamicContentId + "\" style=\"margin-top: -25px;\"><a href=\"#\"><img src='../images/logo.png' width=40px></a></li>");
    			}
			}
			else {
				$("#dash").css("position", "relative");
				$("#dash").css("top", "-150");
				$("#dash").css("width", "88%");
				$("#logo").css("display", "block");
				if ($("#" + dynamicContentId).length > 0) {
					$("#" + dynamicContentId).remove();
    			}
			}
		});
	</script>
</head>

<body>
	<header class="head">
    	<div id="logo"><a href="#"><img src="../images/logo.png" style="width:100%;"></a></div>
		<div class="dash" id="dash">
			<nav>
				<ul id="subs">
					<li><a href="#">Just IN!</a>
						<ul>
							<li id="1_1"><a href="../justin/news.php">News Articles</li></a>
						</ul>
					</li>
					<li><a href="#">Match Centre</a>
						<ul>
							<li id="2_1"><a href="../match/prematch.php">Match Previews</li></a>
							<hr style="margin:5px;">
							<li id="2_2"><a href="../match/match1.php"><?php echo($_SESSION['team1']);?> Match Statistics</li></a>
							<hr style="margin:5px;">
							<li id="2_2"><a href="../match/match2.php"><?php echo($_SESSION['team2']);?> Match Statistics</li></a>
						</ul>
					</li>
					<li><a href="#">Tournaments</a>
						<ul>
							<li id="3_1"><a href="../leagues/?option=cup">FIFA World Cup 2014</li></a>
							<hr style="margin:5px;">
							<li id="3_2"><a href="../leagues/?option=ucl">UEFA Champions League</li></a>
							<li id="3_3"><a href="../leagues/?option=uel">UEFA Europa League</li></a>
							<li id="3_4"><a href="../leagues/?option=epl">Barclays Premier League</li></a>
							<li id="3_5"><a href="../leagues/?option=spl">La Liga</li></a>
							<li id="3_6"><a href="../leagues/?option=ser">Serie A</li></a>
							<li id="3_7"><a href="../leagues/?option=bun">Bundesliga</li></a>
						</ul>
					</li>
					<li><a href="#">Teams</a>
						<ul>
						<?php 
						if($_SESSION['log']==1)
						{
						?>
							<li id="4_1"><a href="../teams/?option=<?php echo($_SESSION['favt1']);?>"><?php echo($_SESSION['team1']);?></li></a>
							<li id="4_2"><a href="../teams/?option=<?php echo($_SESSION['favt2']);?>"><?php echo($_SESSION['team2']);?></li></a>
							<hr style="margin:5px;">
						<?php
						}
						?>
							<li id="4_3"><a href="../filter/?option=UCL">in UCL</li></a>
							<li id="4_4"><a href="../filter/?option=UEL">in UEL</li></a>
							<li id="4_5"><a href="../filter/?option=EPL">in BPL</li></a>
							<li id="4_6"><a href="../filter/?option=SPL">in La Liga</li></a>
							<li id="4_7"><a href="../filter/?option=SER">in Serie A</li></a>
							<li id="4_8"><a href="../filter/?option=BUN">in Bundesliga</li></a>
							<hr style="margin:5px;">
							<li id="4_9"><a href="../teams/nteams.php">National teams</li></a>
						</ul>
					<li><a href="../gallery">Gallery</li></a>
					<li><a href="../feedback/">Contact us</li></a>
					<input type="text" id="search" name="search" class="search"></input>
                    <li>
						<?php 
						if($_SESSION['log']==1)
						{
							echo "Hi, ".$_SESSION['name'];
						}
						else
						{
							echo "Hi, Guest";
						}
						?>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	
	<div id="page">
		<h2>EPL Upcoming Fixtures</h2>
			<table width="80%" cellspacing="0">
				<thead>
					<tr id="attr">
						<td align="left" width="30">S.no</td>
						<td width="2"></td>
						<td align="left" width="70">Date</td>
						<td width="2"></td>
						<td align="left" width="70">Time</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Home)</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Away)</td>
					</tr>
				</thead>
				<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
					<?php
					for ($x=1;$x<$i;$x++)
					{
					echo("
					<tr id='attr1'>
								<td align='left' width='30' class=\"oddcol\">$x</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"evencol\">$edate[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"oddcol\">$etime[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"evencol\">$eht[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"oddcol\">$eat[$x]</td>
							</tr>
							");
						}
						?>
					
			</table>
		<h2>UCL Upcoming Fixtures</h2>
			<table width="80%" cellspacing="0">
				<thead>
					<tr id="attr">
						<td align="left" width="30">S.no</td>
						<td width="2"></td>
						<td align="left" width="70">Date</td>
						<td width="2"></td>
						<td align="left" width="70">Time</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Home)</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Away)</td>
					</tr>
				</thead>
				<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
					<?php
					for ($x=1;$x<$j;$x++)
					{
					echo("
					<tr id=\"attr1\">
						<td align='left' width='30' class=\"oddcol\">$x</td>
						<td width='2'></td>
						<td align='left' width='70' class=\"evencol\">$ucdate[$x]</td>
						<td width='2'></td>
						<td align='left' width='70' class=\"oddcol\">$uctime[$x]</td>
						<td width='2'></td>
						<td align='left' width='70' class=\"evencol\">$ucht[$x]</td>
						<td width='2'></td>
						<td align='left' width='70' class=\"oddcol\">$ucat[$x]</td>
					</tr>
					");
					}
					?>
					
			</table>
		<h2>UEL Upcoming Fixtures</h2>
			<table width="80%" cellspacing="0">
				<thead>
					<tr id="attr">
						<td align="left" width="30">S.no</td>
						<td width="2"></td>
						<td align="left" width="70">Date</td>
						<td width="2"></td>
						<td align="left" width="70">Time</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Home)</td>
						<td width="2"></td>
						<td align="left" width="70">TEAM(Away)</td>
					</tr>
				</thead>
					<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
					<?php
					for ($x=1;$x<$k;$x++)
					{
					echo("
					<tr id='attr1'>
								<td align='left' width='30' class=\"oddcol\">$x</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"evencol\">$date[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"oddcol\">$time[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"evencol\">$ht[$x]</td>
								<td width='2'></td>
								<td align='left' width='70' class=\"oddcol\">$at[$x]</td>
							</tr>
							");
						}
						?>
					
			</table>
		</div>
	</body>
			
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>

</html>