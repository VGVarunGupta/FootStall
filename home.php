<?php
    session_start();
	include('Db_info.php');
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$result = mysql_query("SELECT * FROM `news` ORDER BY `news`.`Date of addition` desc");
	$search1 = mysql_query("SELECT `cname` FROM `clubs` WHERE `cid`=\"$_SESSION[favt1]\"");
	$row = mysql_fetch_array($search1);
	$team1=$row['cname'];
	$search2 = mysql_query("SELECT `cname` FROM `clubs` WHERE `cid`=\"$_SESSION[favt2]\"");
	$row = mysql_fetch_array($search2);
	$team2=$row['cname'];
	$_SESSION['team1'] = $team1;
	$_SESSION['team2'] = $team2;
	$i=0;
	while($row = mysql_fetch_array($result))
		{
			$Title[$i]=$row['description'];
			$linkText[$i]=$row['linkText'];
			$imageurl[$i]=$row['image_url'];
			if ($Title[$i]=="undefined")
			{
				$Title[$i]="In the News";
			}
			$i=$i+1;
		}
?>
<html>
<head>
	<title>FootStall - Ultimate Footballing Destination</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/demo_slider.css" />
    <link rel="stylesheet" type="text/css" href="css/style2_slider.css" />
	<noscript><link rel="stylesheet" type="text/css" href="css/nojs_slider.css" /></noscript>
	<link href='http://fonts.googleapis.com/css?family=Voces' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/modernizr.custom.28468_slider.js"></script>
	<script type="text/javascript" src="js/jquery-2.0.3.js"></script>
	<script type="text/javascript" src="js/jquery.cslider_slider.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#da-slider').cslider({
				autoplay	: true,
				bgincrement	: 450
			});
		});
		$(function()			
		{
			$.ajax(
				{
					url: "http://api.espn.com/v1/sports/soccer/news/headlines",
					data: 
						{
							// enter your developer api key here
							apikey: "dj8m25y2ze94hqsjb2era2t5",
							// the type of data you're expecting back from the api
							_accept: "application/json"
						},
					dataType: "jsonp",
					success: function(data) 
						{
							$.each(data.headlines, function() 
								{
									var headline = this.headline;
									var news_id = this.id;
									var title = this.title;
									var description= this.description;
									var keywords = this.keywords;
									var linkText = this.linkText;
									$.each(this.images, function() 
										{
											var url=this.url;
											var dataString = 'headline='+ headline + '&news_id=' + news_id + '&title=' + title + '&description=' + description + '&keywords=' + keywords + '&linkText=' + linkText + '&url=' + url;    
											$.ajax(
												{  
													type: "POST",  
													url: "inser.php",  
													data: dataString,	 
												}); 
										});
								});
						}
				});
		});
	</script>
	<link rel="stylesheet" type="text/css" href="css/common_circle.css" />
    <link rel="stylesheet" type="text/css" href="css/style6_circle.css" />
	<script type="text/javascript" src="js/modernizr.custom.79639_circle.js"></script>
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
					$("#subs").prepend("<li id=\"" + dynamicContentId + "\" style=\"margin-top: -25px;\"><a href=\"#\"><img src='images/logo.png' width=40px></a></li>");
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
    	<div id="logo"><a href="#"><img src="images/logo.png" style="width:100%;"></a></div>
		<div class="dash" id="dash">
			<nav>
				<ul id="subs">
					<li><a href="#">Just IN!</a>
						<ul>
							<li id="1_1"><a href="justin/news.php">News Articles</li></a>
						</ul>
					</li>
					<li><a href="#">Match Centre</a>
						<ul>
							<li id="2_1"><a href="match/prematch.php">Match Previews</li></a>
							<?php 
							if ($_SESSION['log']==1)
							{
							?>
							<hr style="margin:5px;">
							<li id="2_2"><a href="match/match1.php"><?php echo($team1);?> Match Statistics</li></a>
							<hr style="margin:5px;">
							<li id="2_2"><a href="match/match2.php"><?php echo($team2);?> Match Statistics</li></a>
							<?php
							}
							?>
						</ul>
					</li>
					<li><a href="#">Tournaments</a>
						<ul>
							<li id="3_1"><a href="leagues/?option=cup">FIFA World Cup 2014</li></a>
							<hr style="margin:5px;">
							<li id="3_2"><a href="leagues/?option=ucl">UEFA Champions League</li></a>
							<li id="3_3"><a href="leagues/?option=uel">UEFA Europa League</li></a>
							<li id="3_4"><a href="leagues/?option=epl">Barclays Premier League</li></a>
							<li id="3_5"><a href="leagues/?option=spl">La Liga</li></a>
							<li id="3_6"><a href="leagues/?option=ser">Serie A</li></a>
							<li id="3_7"><a href="leagues/?option=bun">Bundesliga</li></a>
						</ul>
					</li>
					<li><a href="#">Teams</a>
						<ul>
						<?php 
						if($_SESSION['log']==1)
						{
						?>
							<li id="4_1"><a href="teams/?option=<?php echo($_SESSION['favt1']);?>"><?php echo($team1);?></li></a>
							<li id="4_2"><a href="teams/?option=<?php echo($_SESSION['favt2']);?>"><?php echo($team2);?></li></a>
							<hr style="margin:5px;">
						<?php
						}
						?>
							<li id="4_3"><a href="filter/?option=UCL">in UCL</li></a>
							<li id="4_4"><a href="filter/?option=UEL">in UEL</li></a>
							<li id="4_5"><a href="filter/?option=EPL">in BPL</li></a>
							<li id="4_6"><a href="filter/?option=SPL">in La Liga</li></a>
							<li id="4_7"><a href="filter/?option=SER">in Serie A</li></a>
							<li id="4_8"><a href="filter/?option=BUN">in Bundesliga</li></a>
							<hr style="margin:5px;">
							<li id="4_9"><a href="teams/nteams.php">National teams</li></a>
						</ul>
					<li><a href="gallery">Gallery</li></a>
					<li><a href="feedback/">Contact us</li></a>
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
	
	<div id="container">
		<div id="da-slider" class="da-slider">
			<div class="da-slide" id="slide_1">
				<h2><?php echo $Title[0] ;?></h2></h2>
				<p><br><?php echo $linkText[0];?></p>
				<a href="#" class="da-link">Read more</a>
				<div class="da-img"><img src=<?php echo $imageurl[0] ;?> alt="image01" width=356/></div>
			</div>
			<div class="da-slide" id="slide_2">
				<h2><?php echo $Title[1] ;?></h2>
				<p><br><?php echo $linkText[1];?></p>
				<a href="#" class="da-link">Read more</a>
				<div class="da-img"><img src="<?php echo $imageurl[1]; ?>" alt="image01"  width=356/></div>
			</div>
			<div class="da-slide" id="slide_3">
				<h2><?php echo $Title[2] ;?></h2>
				<p><br><?php echo $linkText[2];?></p>
				<a href="#" class="da-link">Read more</a>
				<div class="da-img"><img src="<?php echo $imageurl[2]; ?>" alt="image01"  width=356/></div>
			</div>
			<div class="da-slide" id="slide_4">
				<h2><?php echo $Title[3] ;?></h2>
				<p><br><?php echo $linkText[3];?></p>
				<a href="#" class="da-link">Read more</a>
				<div class="da-img"><img src="<?php echo $imageurl[3]; ?>" alt="image01"  width=356/></div>
			</div>
		</div>
    </div>
	
	<div id="page">	
		<section class = "sectl">
			<div class = "textl">Matches around the globe</div>
			<div><img src="images/Match.png" width=256px></div>
		</section>
		<section class = "sectr">
			<div class = "textr">The v/s Section</div>
			<div><img src="images/Poll.jpg" width=256px style="margin: 30px 10px 30px 30px;"></div>
		</section>
		<section class = "sectl">
			<div class = "textl">Stats Corner</div>
			<div><img src="images/Stats.png" width=256px></div>
		</section>
	</div>
	
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>
</body>
</html>