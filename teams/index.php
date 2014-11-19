<?php
	session_start();
	include("../Db_info.php");
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	if(isset($_GET['option']) && !empty($_GET['option']))
	{  
		$option = mysql_escape_string($_GET['option']);
		$search = mysql_query("SELECT * FROM `clubs` where `cid`= \"".$option."\"") or die(mysql_error());
		$row = mysql_fetch_array($search);
		if($row)
		{
?>
<html>
<head>
	<title>FootStall - Teams</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="../js/jquery-2.0.3.js"></script>
	<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
	
	<link rel="stylesheet" href="//api.statsfc.com/widget/fixtures.css">
	<script src="//api.statsfc.com/widget/fixtures-2.0.min.js"></script>

	<!-- For the Live Match Stats -->
	<link rel="stylesheet" href="//api.statsfc.com/widget/live.css">
	<script src="//api.statsfc.com/widget/live-2.0.min.js"></script>

	<!-- For the Team Form Stats -->
	<link rel="stylesheet" href="//api.statsfc.com/widget/form.css">
	<script src="//api.statsfc.com/widget/form-2.0.min.js"></script>

	<!-- For the Result Stats -->
	<link rel="stylesheet" href="//api.statsfc.com/widget/results.css">
	<script src="//api.statsfc.com/widget/results-2.0.min.js"></script>

	<!-- For top Scorers -->
	<link rel="stylesheet" href="//api.statsfc.com/widget/top-scorers.css">
	<script src="//api.statsfc.com/widget/top-scorers-2.0.min.js"></script>

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
		<div style="margin-left:auto; margin-right:auto; position: relative; width: 65%;">
			<img src="<?php echo($row['crest']);?>" height=200px style="float:left; padding:30px; margin-left: 50px;">
			<div class="name"><?php echo($row['cname']);?></div>
		</div>
		<div style="margin-left:auto; margin-right:auto; position: relative; width: 30%;">
			<div style="float: left;">
				<div style="padding:10px;">Location : <?php echo($row['city'].", ".$row['country']);?></div>
				<div style="padding:10px;">Manager : <?php echo($row['manager']);?></div>
				<div style="padding:10px;">Nickname : <?php echo($row['nick']);?></div>
				<div style="padding:10px;">Stadium : <?php echo($row['stadium']);?></div>
				<div style="padding:10px;">Last Season Rank : <?php echo($row['last_standing']);?></div>
				<div style="padding:10px;">Highest League Rank : <?php echo($row['high_standing']);?></div>
			</div>
			<div style="margin-top: 20px; float: left; box-shadow: 7px 7px 20px #000;"><img src="<?php echo($row['stad_pic']);?>" width="300"></div>
			<div class="desc"><?php echo($row['desc']);?></div>
			<div style="display: flex;">
				<img src="<?php echo($row['kit1']);?>" width="100" style="margin:50px; float: left;">
				<img src="<?php echo($row['kit2']);?>" width="100" style="margin:50px; float: left;">
			</div>
			<div class="desc" style="padding:0;">Home and Away Kits for 2013-14</div>
		</div>
		<?php
		if ($row['country'] == "England")
		{
		?>

			<div class="desc" style="font-size: 20px; font-weight:bold;">EPL Results 2013-14</div>
			<div id="statsfc-results" style="width: 60%; margin-left: auto; margin-right: auto;"></div>
			<div class="desc" style="font-size: 20px; font-weight:bold;">Upcoming fixtures 2013-14</div>
			<div id="statsfc-fixtures" style="width: 60%; margin-left: auto; margin-right: auto;"></div>

			<!-- For the Fixtures Stats -->
			<script>
				var fixtures = new StatsFC_Fixtures('_6VPnNqK4oHY7tDM4IMTTOxkjdIefZwNbPYhQTbw');
				fixtures.competition = 'premier-league';
				fixtures.highlight = <?php echo("'".$row['cname']."'");?>;
				fixtures.team = <?php echo("'".$row['cname']."'");?>;
				fixtures.showBadges = true;
				fixtures.display('statsfc-fixtures');
			</script>

			<!-- For the Result Stats -->
			<script>
				var results = new StatsFC_Results('_6VPnNqK4oHY7tDM4IMTTOxkjdIefZwNbPYhQTbw');
				results.competition = 'premier-league';
				results.highlight = <?php echo("'".$row['cname']."'");?>;
				results.team = <?php echo("'".$row['cname']."'");?>;
				results.goals = true;
				results.cards = true;
				results.showBadges = true;
				results.display('statsfc-results');
			</script>
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
	}
	else
	{
		echo "Error occured: " . mysql_error();
	}
?>