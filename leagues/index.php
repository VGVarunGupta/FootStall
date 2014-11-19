<?php
	session_start();
	include("../Db_info.php");
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	if(isset($_GET['option']) && !empty($_GET['option']))
	{  
		$option = mysql_escape_string($_GET['option']);
		$search = mysql_query("SELECT * FROM leagues where `lid`= \"".$option."\"") or die(mysql_error());
		$match  = mysql_num_rows($search);
		$table_name= $option . '_2013-2014' ;
		if ($option=="epl" OR $option=="ser" OR $option=="spl" OR $option=="bun")
			{
				$sql=	  mysql_query("Select * from `$table_name` ORDER BY `Pos` ASC ");
			}
		else if ($option=="uel" OR $option=="ucl")
			{
				$sql=	  mysql_query("Select * from `$table_name` ORDER BY `GR`,`Pos` ASC");
			}
		$i=1;
		while($option!="cup" AND $row = mysql_fetch_array($sql))
		{
		$que=mysql_query("Select * from clubs where cname=\"".$row['cname']."\" ") ;
		$r=mysql_num_rows($que);
		if ($r ==1)
		{
		$li[$i]=1;
		}
		$TEAM[$i]=$row['cname'];
		$POS[$i]=$row['Pos'];
		$id[$i]=$row['cid'];
		$GROUP[$i]=$row['GR'];
		$P[$i]=$row['Pl'];
		$W[$i]=$row['W'];
		$D[$i]=$row['D'];
		$L[$i]=$row['L'];
		$F[$i]=$row['GS'];
		$A[$i]=$row['GA'];
		$HW[$i]=$row['HW'];
		$HD[$i]=$row['HD'];
		$HL[$i]=$row['HL'];
		$HF[$i]=$row['HGS'];
		$HA[$i]=$row['HGA'];
		$AW[$i]=$row['AW'];
		$AD[$i]=$row['AD'];
		$AL[$i]=$row['AL'];
		$AF[$i]=$row['AGS'];
		$AA[$i]=$row['AGA'];
		$GD[$i]=$row['GD'];
		$Pts[$i]=$row['Pt'];
		if ($li[$i]==1)
		{
		$links[$i]="../teams/?option=". $id[$i] ;
		}
		else
		{
		$links[$i]="#";
		}
		$i+=1;
		}
        if($match > 0)
		{
			$row = mysql_fetch_array($search);
			
?>
<html>
<head>
	<title>FootStall - Barclays Premier League</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//api.statsfc.com/widget/form.css">
	<script src="//api.statsfc.com/widget/form-2.0.min.js"></script>
	<link rel="stylesheet" href="//api.statsfc.com/widget/top-scorers.css">
	<script src="//api.statsfc.com/widget/top-scorers-2.0.min.js"></script>
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
<body style="background: url('../images/backs/<?php echo($row['back']);?>'); background-attachment: fixed; background-size: cover;">
	
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
		<img src="../<?php echo($row['logo']);?>" height=200px style="float:left; padding:30px; margin-left: 50px;">
		<div class="lname"><?php echo($row['lname']);?></div>
		<div style="margin: 31px auto -20px 50px;">Region : <?php echo($row['country']);?></div>
		<div class="desc"><?php echo($row['desc']);?></div>
		<?php
		if ($option=="epl" OR $option=="ser" OR $option=="spl" OR $option=="bun")
		{
		?>
			<table width="100%" cellspacing="0">
				<thead>
					<tr id="attr">
						<td colspan="4">&nbsp;</td>
						<td align="center" colspan="6">Overall</td>
						<td width="2"></td>
						<td align="center" colspan="5">Home</td>
						<td width="2"></td>
						<td align="center" colspan="5">Away</td>
						<td width="2"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr id="attr1">
						<td>POS</td>
						<td width="2"></td>
						<td align="left" width="700">TEAM</td>
						<td width="2"></td>
						<td width="22">P</td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">GD</td>
						<td width="22">Pts</td>
					</tr>
				</thead>
				<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
				<?php
					$x=1;
					for ($x=1; $x<=$row['cqual']; $x++)
					{	echo("
					<tr style=\"background: rgb(129, 214, 172);\">
						<td>$x</td>
						<td width='2'></td>
						<td align='left' width='700'>
						<a href='$links[$x]'>$TEAM[$x]</td>
						<td width='2'></td>
						<td width='22'>$P[$x]</td>
						<td width='22'>$W[$x]</td>
						<td width='22'>$D[$x]</td>
						<td width='22'>$L[$x]</td>
						<td width='22'>$F[$x]</td>
						<td width='22'>$A[$x]</td>
						<td width='2'></td>
						<td width='22'>$HW[$x]</td>
						<td width='22'>$HD[$x]</td>
						<td width='22'>$HL[$x]</td>
						<td width='22'>$HF[$x]</td>
						<td width='22'>$HA[$x]</td>
						<td width='2'></td>
						<td width='22'>$AW[$x]</td>
						<td width='22'>$AD[$x]</td>
						<td width='22'>$AL[$x]</td>
						<td width='22'>$AF[$x]</td>
						<td width='22'>$AA[$x]</td>
						<td width='2'></td>
						<td width='22'>$GD[$x]</td>
						<td width='22'>$Pts[$x]</td>
					</tr>");
					}
					?>
					<?php
					echo("
					<tr style=\"background: rgb(129, 214, 172);\">
						<td>$x</td>
						<td width='2'></td>
						<td align='left' width='700'><a href='$links[$x]'>$TEAM[$x]</td>
						<td width='2'></td>
						<td width='22'>$P[$x]</td>
						<td width='22'>$W[$x]</td>
						<td width='22'>$D[$x]</td>
						<td width='22'>$L[$x]</td>
						<td width='22'>$F[$x]</td>
						<td width='22'>$A[$x]</td>
						<td width='2'></td>
						<td width='22'>$HW[$x]</td>
						<td width='22'>$HD[$x]</td>
						<td width='22'>$HL[$x]</td>
						<td width='22'>$HF[$x]</td>
						<td width='22'>$HA[$x]</td>
						<td width='2'></td>
						<td width='22'>$AW[$x]</td>
						<td width='22'>$AD[$x]</td>
						<td width='22'>$AL[$x]</td>
						<td width='22'>$AF[$x]</td>
						<td width='22'>$AA[$x]</td>
						<td width='2'></td>
						<td width='22'>$GD[$x]</td>
						<td width='22'>$Pts[$x]</td>
					</tr>");
					?>
				<?php
					for ($i=$x+1; $i<=($x+$row['equal']); $i++)
					{	echo("
					<tr style=\"background: rgb(178, 191, 208);\">	
						<td>$i</td>
						<td width='2'></td>
						<td align='left' width='700'><a href='$links[$i]'>$TEAM[$i]</td>
						<td width='2'></td>
						<td width='22'>$P[$i]</td>
						<td width='22'>$W[$i]</td>
						<td width='22'>$D[$i]</td>
						<td width='22'>$L[$i]</td>
						<td width='22'>$F[$i]</td>
						<td width='22'>$A[$i]</td>
						<td width='2'></td>
						<td width='22'>$HW[$i]</td>
						<td width='22'>$HD[$i]</td>
						<td width='22'>$HL[$i]</td>
						<td width='22'>$HF[$i]</td>
						<td width='22'>$HA[$i]</td>
						<td width='2'></td>
						<td width='22'>$AW[$i]</td>
						<td width='22'>$AD[$i]</td>
						<td width='22'>$AL[$i]</td>
						<td width='22'>$AF[$i]</td>
						<td width='22'>$AA[$i]</td>
						<td width='2'></td>
						<td width='22'>$GD[$i]</td>
						<td width='22'>$Pts[$i]</td>
					</tr>");
					}
					for ($j=$i; $j<=17; $j++)
					{	echo("
					<tr>
						<td class=\"oddcol\">".$j."</td>
						<td width=\"2\"></td>
						<td class=\"evencol\" align=\"left\"><a href='$links[$j]'>$TEAM[$j]</td>
						<td width=\"2\"></td>
						<td class=\"oddcol\" width=\"22\">$P[$j]</td>
						<td class=\"oddcol\" width=\"22\">$W[$j]</td>
						<td class=\"oddcol\" width=\"22\">$D[$j]</td>
						<td class=\"oddcol\" width=\"22\">$L[$j]</td>
						<td class=\"oddcol\" width=\"22\">$F[$j]</td>
						<td class=\"oddcol\" width=\"22\">$A[$j]</td>
						<td width=\"2\"></td>
						<td class=\"evencol\" width=\"22\">$HW[$j]</td>
						<td class=\"evencol\" width=\"22\">$HD[$j]</td>
						<td class=\"evencol\" width=\"22\">$HL[$j]</td>
						<td class=\"evencol\" width=\"22\">$HF[$j]</td>
						<td class=\"evencol\" width=\"22\">$HA[$j]</td>
						<td width=\"2\"></td>
						<td class=\"oddcol\" width=\"22\">$AW[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AD[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AL[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AF[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AA[$j]</td>
						<td width=\"2\"></td>
						<td class=\"evencol\" width=\"22\">$GD[$j]</td>
						<td class=\"evencol\" width=\"22\">$Pts[$j]</td>
					</tr>");
					}
					?>
						<?php
					echo("
					<tr style=\"background: rgb(255, 127, 132);\">
						<td>18</td>
						<td width='2'></td>
						<td align='left' width='700'><a href='$links[18]'>$TEAM[18]</td>
						<td width='2'></td>
						<td width='22'>$P[18]</td>
						<td width='22'>$W[18]</td>
						<td width='22'>$D[18]</td>
						<td width='22'>$L[18]</td>
						<td width='22'>$F[18]</td>
						<td width='22'>$A[18]</td>
						<td width='2'></td>
						<td width='22'>$HW[18]</td>
						<td width='22'>$HD[18]</td>
						<td width='22'>$HL[18]</td>
						<td width='22'>$HF[18]</td>
						<td width='22'>$HA[18]</td>
						<td width='2'></td>
						<td width='22'>$AW[18]</td>
						<td width='22'>$AD[18]</td>
						<td width='22'>$AL[18]</td>
						<td width='22'>$AF[18]</td>
						<td width='22'>$AA[18]</td>
						<td width='2'></td>
						<td width='22'>$GD[18]</td>
						<td width='22'>$Pts[18]</td>
					</tr>");
					echo("
					<tr style=\"background: rgb(255, 127, 132);\">
						<td>19</td>
						<td width='2'></td>
						<td align='left' width='700'><a href='$links[19]'>$TEAM[19]</td>
						<td width='2'></td>
						<td width='22'>$P[19]</td>
						<td width='22'>$W[19]</td>
						<td width='22'>$D[19]</td>
						<td width='22'>$L[19]</td>
						<td width='22'>$F[19]</td>
						<td width='22'>$A[19]</td>
						<td width='2'></td>
						<td width='22'>$HW[19]</td>
						<td width='22'>$HD[19]</td>
						<td width='22'>$HL[19]</td>
						<td width='22'>$HF[19]</td>
						<td width='22'>$HA[19]</td>
						<td width='2'></td>
						<td width='22'>$AW[19]</td>
						<td width='22'>$AD[19]</td>
						<td width='22'>$AL[19]</td>
						<td width='22'>$AF[19]</td>
						<td width='22'>$AA[19]</td>
						<td width='2'></td>
						<td width='22'>$GD[19]</td>
						<td width='22'>$Pts[19]</td>
					</tr>
						<tr style=\"background: rgb(255, 127, 132);\">
						<td>20</td>
						<td width='2'></td>
						<td align='left' width='700'><a href='$links[20]'>$TEAM[20]</td>
						<td width='2'></td>
						<td width='22'>$P[20]</td>
						<td width='22'>$W[20]</td>
						<td width='22'>$D[20]</td>
						<td width='22'>$L[20]</td>
						<td width='22'>$F[20]</td>
						<td width='22'>$A[20]</td>
						<td width='2'></td>
						<td width='22'>$HW[20]</td>
						<td width='22'>$HD[20]</td>
						<td width='22'>$HL[20]</td>
						<td width='22'>$HF[20]</td>
						<td width='22'>$HA[20]</td>
						<td width='2'></td>
						<td width='22'>$AW[20]</td>
						<td width='22'>$AD[20]</td>
						<td width='22'>$AL[20]</td>
						<td width='22'>$AF[20]</td>
						<td width='22'>$AA[20]</td>
						<td width='2'></td>
						<td width='22'>$GD[20]</td>
						<td width='22'>$Pts[20]</td>
					</tr>");
					?>
				</tbody>
			</table>
			<div style="position: relative; width: 300px; margin: 0 auto;">
			<p><div style="width:20px; margin-right: 10px; height:20px; float:left; background-color:#81D6AC"></div>Qualified for Champions League</p>
			<p><div style="width:20px; margin-right: 10px; height:20px; float:left; background-color:#B5E7CE"></div>Champions League cqualifying</p>
			<p><div style="width:20px; margin-right: 10px; height:20px; float:left; background-color:#B2BFD0"></div>Europa League cqualifying</p>
			<p><div style="width:20px; margin-right: 10px; height:20px; float:left; background-color:#FF7F84"></div>Relegated</p><br><br></div>
			<div style="text-align:center">
			P:Played&nbsp;&nbsp;&nbsp; W:Won&nbsp;&nbsp;&nbsp; L:Lost&nbsp;&nbsp;&nbsp; D:Draw&nbsp;&nbsp;&nbsp; F: Goals for&nbsp;&nbsp;&nbsp; A: Goals against&nbsp;&nbsp;&nbsp; GD: Goal difference&nbsp;&nbsp;&nbsp; Pts: Points
			</div>
		<?php
		} else if ($option=="ucl" OR $option=="uel"){
		?>
			<table width="100%" cellspacing="0">
				<thead>
					<tr id="attr">
						<td colspan="6">&nbsp;</td>
						<td align="center" colspan="6">Overall</td>
						<td width="2"></td>
						<td align="center" colspan="5">Home</td>
						<td width="2"></td>
						<td align="center" colspan="5">Away</td>
						<td width="2"></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr id="attr1">
						<td>POS</td>
						<td width="2"></td>
						<td align="left" width="700">TEAM</td>
						<td width="2"></td>
						<td>GROUP</td>
						<td width="2"></td>
						<td width="22">P</td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">W</td>
						<td width="22">D</td>
						<td width="22">L</td>
						<td width="22">F</td>
						<td width="22">A</td>
						<td width="2"></td>
						<td width="22">GD</td>
						<td width="22">Pts</td>
					</tr>
				</thead>
				<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
				<?php
					$x=1; $z=65;
					for ($z=0; $z<($row['cqual']); $z++)
					{
						for ($a=1; $a<=2; $a++)
						{
							$x=($a + (4*$z)); 
						echo("
						<tr style=\"background: rgb(129, 214, 172);\">
							<td>$POS[$x]</td>
							<td width='2'></td>
							<td align='left' width='700'><a href='$links[$x]'>$TEAM[$x]</td>
							<td width='2'></td>
							<td>$GROUP[$x]</td>
							<td width='2'></td>
							<td width='22'>$P[$x]</td>
						<td width='22'>$W[$x]</td>
						<td width='22'>$D[$x]</td>
						<td width='22'>$L[$x]</td>
						<td width='22'>$F[$x]</td>
						<td width='22'>$A[$x]</td>
						<td width='2'></td>
						<td width='22'>$HW[$x]</td>
						<td width='22'>$HD[$x]</td>
						<td width='22'>$HL[$x]</td>
						<td width='22'>$HF[$x]</td>
						<td width='22'>$HA[$x]</td>
						<td width='2'></td>
						<td width='22'>$AW[$x]</td>
						<td width='22'>$AD[$x]</td>
						<td width='22'>$AL[$x]</td>
						<td width='22'>$AF[$x]</td>
						<td width='22'>$AA[$x]</td>
						<td width='2'></td>
						<td width='22'>$GD[$x]</td>
						<td width='22'>$Pts[$x]</td>
						</tr>");
						}
						for ($b=3; $b<=4; $b++)
						{
						$j=($b + (4*$z)); 
						echo("
						<tr>
							<td class=\"oddcol\">$POS[$j]</td>
							<td width=\"2\"></td>
							<td class=\"evencol\" align=\"left\"><a href='$links[$j]'>$TEAM[$j]</td>
							<td width='2'></td>
							<td>$GROUP[$j]</td>	
						<td width=\"2\"></td>
						<td class=\"oddcol\" width=\"22\">$P[$j]</td>
						<td class=\"oddcol\" width=\"22\">$W[$j]</td>
						<td class=\"oddcol\" width=\"22\">$D[$j]</td>
						<td class=\"oddcol\" width=\"22\">$L[$j]</td>
						<td class=\"oddcol\" width=\"22\">$F[$j]</td>
						<td class=\"oddcol\" width=\"22\">$A[$j]</td>
						<td width=\"2\"></td>
						<td class=\"evencol\" width=\"22\">$HW[$j]</td>
						<td class=\"evencol\" width=\"22\">$HD[$j]</td>
						<td class=\"evencol\" width=\"22\">$HL[$j]</td>
						<td class=\"evencol\" width=\"22\">$HF[$j]</td>
						<td class=\"evencol\" width=\"22\">$HA[$j]</td>
						<td width=\"2\"></td>
						<td class=\"oddcol\" width=\"22\">$AW[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AD[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AL[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AF[$j]</td>
						<td class=\"oddcol\" width=\"22\">$AA[$j]</td>
						<td width=\"2\"></td>
						<td class=\"evencol\" width=\"22\">$GD[$j]</td>
						<td class=\"evencol\" width=\"22\">$Pts[$j]</td>
						</tr>");
						}
						?>
						<tr style="background:rgba(255,255,255,0)">
							<td></td>
							<td width="2"></td>
							<td align="left"></td>
							<td width='2'></td>
							<td></td>
							<td width="2"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="2"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="2"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="22"></td>
							<td width="2"></td>
							<td width="22"></td>
							<td width="22"></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<div style="position: relative; width: 300px; margin: 0 auto;">
			<p><div style="width:20px; margin-right: 10px; height:20px; float:left; background-color:#81D6AC"></div>Qualified for next round</p>
			<br><br></div>
			<div style="text-align:center">
			P:Played&nbsp;&nbsp;&nbsp; W:Won&nbsp;&nbsp;&nbsp; L:Lost&nbsp;&nbsp;&nbsp; D:Draw&nbsp;&nbsp;&nbsp; F: Goals for&nbsp;&nbsp;&nbsp; A: Goals against&nbsp;&nbsp;&nbsp; GD: Goal difference&nbsp;&nbsp;&nbsp; Pts: Points
			</div>
			<?php
		}
		if ($option=="epl")
		{
		?>
			<h1 style="margin:50px auto; display: table;">League Results</h1>
			<div id="statsfc-form" style="margin-left:auto; margin-right:auto; width:40%"></div>
			<h1 style="margin:50px auto; display: table;">League Top Scorers</h1>
			<div id="statsfc-top-scorers" style="margin-left:auto; margin-right:auto; width:40%"></div>
			<script>
				var form = new StatsFC_Form('_6VPnNqK4oHY7tDM4IMTTOxkjdIefZwNbPYhQTbw');
				form.showBadges = true;
				form.showScore = true;
				form.display('statsfc-form');
			</script>
			<!-- For the Top Scorers Stats -->
			<script>
				var topScorers = new StatsFC_TopScorers('_6VPnNqK4oHY7tDM4IMTTOxkjdIefZwNbPYhQTbw');
				topScorers.competition = 'premier-league';
				topScorers.showBadges = true;
				topScorers.display('statsfc-top-scorers');
			</script>
		<?php
		}
		}
		if ($option=="cup") {
		?>
			<table cellspacing="0" style="margin:0 auto; width: 40%;">
				<thead>
					<tr id="attr">
						<td width="5">S.No.</td>
						<td width="5">Group</td>
						<td width="300">Team</td>
					</tr>
				</thead>
				<tbody style="font-family: 'Raleway'; font-size: 0.85em;">
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">A</td>
						<td width="250" class="oddcol">Brazil</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">A</td>
						<td width="250" class="oddcol">Croatia</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">A</td>
						<td width="250" class="oddcol">Mexico</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">A</td>
						<td width="250" class="oddcol">Cameroon</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">B</td>
						<td width="250" class="oddcol">Spain</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">B</td>
						<td width="250" class="oddcol">Holland</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">B</td>
						<td width="250" class="oddcol">Chile</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">B</td>
						<td width="250" class="oddcol">Australia</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">C</td>
						<td width="250" class="oddcol">Colombia</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">C</td>
						<td width="250" class="oddcol">Greece</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">C</td>
						<td width="250" class="oddcol">Ivory Coast</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">C</td>
						<td width="250" class="oddcol">Japan</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">D</td>
						<td width="250" class="oddcol">Uruguay</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">D</td>
						<td width="250" class="oddcol">Costa Rica</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">D</td>
						<td width="250" class="oddcol">England</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">D</td>
						<td width="250" class="oddcol">Italy</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">E</td>
						<td width="250" class="oddcol">Switzerland</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">E</td>
						<td width="250" class="oddcol">Ecaudor</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">E</td>
						<td width="250" class="oddcol">France</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">E</td>
						<td width="250" class="oddcol">Honduras</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">F</td>
						<td width="250" class="oddcol">Argentina</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">F</td>
						<td width="250" class="oddcol">Bosnia and Herzegovina</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">F</td>
						<td width="250" class="oddcol">Iran</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">F</td>
						<td width="250" class="oddcol">Nigeria</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">G</td>
						<td width="250" class="oddcol">Germany</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">G</td>
						<td width="250" class="oddcol">Portugal</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">G</td>
						<td width="250" class="oddcol">Ghana</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">G</td>
						<td width="250" class="oddcol">United States</td>
					</tr>
					<tr style="height:20px;"></tr>
					<tr>
						<td width="5" class="oddcol">1</td>
						<td width="5" class="evencol">H</td>
						<td width="250" class="oddcol">Belgium</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">2</td>
						<td width="5" class="evencol">H</td>
						<td width="250" class="oddcol">Algeria</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">3</td>
						<td width="5" class="evencol">H</td>
						<td width="250" class="oddcol">Russia</td>
					</tr>
					<tr>
						<td width="5" class="oddcol">4</td>
						<td width="5" class="evencol">H</td>
						<td width="250" class="oddcol">South Korea</td>
					</tr>
				</tbody>
			</table>
		<?php
		}
		?>
	</div>
	
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>
</body>
</html>
<?php
	}
	else
	{
		echo "Error occured: " . mysql_error();
	}
?>