<?php include('../Db_info.php'); ?>
<?php
session_start();
$favt1=$_SESSION['favt1'];
$favt2=$_SESSION['favt2'];
$favl=$_SESSION['favl'];
$favc=$_SESSION['favc'];
$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
mysql_select_db($db_name)or die("Cannot Select the database");
$que=mysql_query("Select * from clubs");

/* Code for First Fav. Team */

while($r=mysql_fetch_array($que))
{
if($r['cid']==$favt1)
{
$id=str_split($r['cid'],3);
}
}
$tablename=strtolower($id[0]) . "_fixture" ;
$sql=mysql_query ("Select * from `$tablename` where status=1");
$i=1;
while($row=mysql_fetch_array($sql))
{
	if(($row['home']==$_SESSION['team1']) OR ($row['away']==$_SESSION['team1']))
	{
	$ht[$i]=$row['home'];
	$at[$i]=$row['away'];
	$array=explode(" ",$row['date']);
	$date[$i]=$array[0];
	$time=$array[1];
	$fthg[$i]=$row['fthg'];
	$ftag[$i]=$row['ftag'];
	$ftr[$i]=$row['ftr'];
	if ($ftr[$i]=="H")
		$ftr[$i]=$row['home'];
	else
		$ftr[$i]=$row['away'];
	$hs[$i]=$row['hs'];
	$as[$i]=$row['as'];
	$hst[$i]=$row['hst'];
	$ast[$i]=$row['ast'];
	$hf[$i]=$row['hf'];
	$af[$i]=$row['af'];
	$hc[$i]=$row['hc'];
	$ac[$i]=$row['ac'];
	$hy[$i]=$row['hy'];
	$ay[$i]=$row['ay'];
	$hr[$i]=$row['hr'];
	$ar[$i]=$row['ar'];
	$i+=1;
	}
}

/* code for Second favourite Team */
while($r=mysql_fetch_array($que))
{
if($r['cname']==$favt2)
{
$id=str_split($r['cid'],3);
}
}
$tablename=strtolower($id[0]) . "_fixture" ;
$sql=mysql_query ("Select * from `$tablename` where status=1");
$j=1;
while($row=mysql_fetch_array($sql))
{
	if(($row['home']==$favt2) or ($row['away']==$favt2))
	{
	$ht[$j]=$row['home'];
	$at[$j]=$row['away'];
	$array=explode(" ",$row['date']);
	$date[$j]=$array[0];
	$time=$array[1];
	$fthg[$j]=$row['fthg'];
	$ftag[$j]=$row['ftag'];
	$ftr[$j]=$row['ftr'];
	$hs[$j]=$row['hs'];
	$as[$j]=$row['as'];
	$hst[$j]=$row['hst'];
	$ast[$j]=$row['ast'];
	$hf[$j]=$row['hf'];
	$af[$j]=$row['af'];
	$hc[$j]=$row['hc'];
	$ac[$j]=$row['ac'];
	$hy[$j]=$row['hy'];
	$ay[$j]=$row['ay'];
	$hr[$j]=$row['hr'];
	$ar[$j]=$row['ar'];
	$j+=1;
	}
}
?>
<html>
<head>
	<title>FootStall - Favourite Matches</title>
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
	<h2><?php echo($_SESSION['team1']);?>'s Past Fixtures</h2>
	<table width="100%" cellspacing="0">
		<thead>
			<tr id="attr">
				<td align="left" width="2">S.no</td>
				<td align="left" width="70">Date</td>
				<td align="left" width="70">TEAM(Home)</td>
				<td align="left" width="70">TEAM(Away)</td>
				<td width="2">FTHG</td>
				<td width="2">FTAG</td>
				<td width="2">FTR</td>
				<td width="2">HS</td>
				<td width="2">AS</td>
				<td width="2">HST</td>
				<td width="2">AST</td>
				<td width="2">HF</td>
				<td width="2">AF</td>
				<td width="2">HC</td>
				<td width="2">AC</td>
				<td width="2">HY</td>
				<td width="2">AY</td>
				<td width="2">HR</td>
				<td width="2">AR</td>
			</tr>
		</thead>
		<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
			<?php
			for ($x=1;$x<$i;$x++)
			{
			echo("
			<tr id=\"attr1\">
				<td align=\"left\" width=\"2\" class=\"oddcol\">$x</td>
				<td align=\"left\" width=\"70\" class=\"evencol\">$date[$x]</td>
				<td align=\"left\" width=\"70\" class=\"oddcol\">$ht[$x]</td>
				<td align=\"left\" width=\"70\" class=\"evencol\">$at[$x]</td>
				<td width=\"2\" class=\"oddcol\">$fthg[$x]</td>
				<td width=\"2\" class=\"evencol\">$ftag[$x]</td>
				<td width=\"2\" class=\"oddcol\">$ftr[$x]</td>
				<td width=\"2\" class=\"evencol\">$hs[$x]</td>
				<td width=\"2\" class=\"oddcol\">$as[$x]</td>
				<td width=\"2\" class=\"evencol\">$hst[$x]</td>
				<td width=\"2\" class=\"oddcol\">$ast[$x]</td>
				<td width=\"2\" class=\"evencol\">$hf[$x]</td>
				<td width=\"2\" class=\"oddcol\">$af[$x]</td>
				<td width=\"2\" class=\"evencol\">$hc[$x]</td>
				<td width=\"2\" class=\"oddcol\">$ac[$x]</td>
				<td width=\"2\" class=\"evencol\">$hy[$x]</td>
				<td width=\"2\" class=\"oddcol\">$ay[$x]</td>
				<td width=\"2\" class=\"evencol\">$hr[$x]</td>
				<td width=\"2\" class=\"oddcol\">$hr[$x]</td>
			</tr>");
			}
			?>
		</tbody>
	</table>
	</div>
</body>
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>

</html>