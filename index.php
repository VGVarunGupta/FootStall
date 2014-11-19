<?php 
session_start();
?>
<html>
<head>
	<title>FootStall - Ultimate Footballing Destination</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/common_circle.css" />
	<link rel="stylesheet" type="text/css" href="css/demo_circle.css" />
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'/>
	<script type="text/javascript" src="js/modernizr.custom.79639_circle.js"></script>
        <script type="text/javascript" src="js/jquery-2.0.3.js"></script>
	<script type="text/javascript">
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
				$("#dash").css("width", "auto");
				$("#logo").css("display", "block");
				if ($("#" + dynamicContentId).length > 0) {
					$("#" + dynamicContentId).remove();
    			}
			}
		});
	</script>
		
</head>
<body>
	<?php
	if(isset($_SESSION['log']))
	{
	?>
		<script>
		document.getElementById("err").innerHTML = "You have been logged out";
		setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
		return false;
		</script>
	<?php
		unset ($_SESSION['log']);
	}
	?>
	<script id="facebook-jssdk" async src="//connect.facebook.net/en_US/all.js"></script>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '1420816791489353', // App ID
				channelUrl : 'fundartica.in/footstall', // Channel File
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true,  // parse XFBML
				oauth      : true
			});

			FB.Event.subscribe('auth.authResponseChange', function(response) {
				if (response.status === 'connected') {
				  testAPI();
				} else if (response.status === 'not_authorized') {
				  FB.login(function(){},{scope:'email,user_birthday'});
							} else { 
				  FB.login(function(){},{scope:'email,user_birthday'});
				}
			});
		};

		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1420816791489353";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		function testAPI() {}
		  
		function signin() {
			FB.login(function(){},{scope:'email,user_birthday'});
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
			var social = "Facebook";
			var name = response.name;
			var email = response.email;
			var birth = response.birthday;
			var dates = birth.split("/");
			var date = dates[1];
			var month = dates[0];
			var year = dates[2];
			var postdata = {
				'SOCIAL' : social,
				'NAME': name,
				'EMAIL':email,
				'DATE':date,
				'MONTH':month,
				'YEAR':year
			};
			$.ajax({  
				type: "POST",  
				url: "insert_social.php",  
				data: postdata, 
	                        
				success: function(result){
					if(result == 2){
						document.getElementById("err").innerHTML = "*Registration failed";
						setTimeout(function(){document.getElementById("err").innerHTML = "&nbsp;"}, 4000);
					}
				}
			});
			});
		}
	</script>
	
	<div style="min-height:97.7%;">
		<header class="head">
			<div class="logo" id="logo">
				<img src="images/logo.png">
			</div>
		</header>
		
		<p id = "err" class = "error" align = center>&nbsp;</p>
		<div class="container">
			<section class="main">
				<ul class="ch-grid">
					<li>
						<div class="ch-item">	
							<div class="ch-info">
								<h3>Continue as Guest</h3>
								<p><a href="home.php">Proceed</a></p>
							</div>
							<div class="ch-thumb ch-img-1"></div>
						</div>
					</li>
					<li>
						<div class="ch-item">	
							<div class="ch-info">
								<h3>Sign in to FootStall</h3>
								<p><a href="checkin.php">Proceed</a></p>
							</div>
							<div class="ch-thumb ch-img-2"></div>
						</div>
					</li>
					<li>
						<div class="ch-item">	
							<div class="ch-info">
								<h3 id="circle3">Sign in using Facebook</h3>
								<p onClick=signin()><a>Proceed</a></p>
							</div>
							<div class="ch-thumb ch-img-3"></div>
						</div>
					</li>
				</ul>
			</section>	
		</div>
	</div>
	<footer class="foot">
		<div id="text">&copy; Developed and Maintained by Ankit Arora, Arjit Agarwal and Varun Gupta</div>
	</footer>
</body>
</html>