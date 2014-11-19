<?php
	include('Db_info.php');
?>
<?php
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$sql=
		"INSERT INTO news
			( news_id, headline , description , keywords , linkText , title ,image_url ) 
			VALUES 	
			('$_POST[news_id]','$_POST[headline]', '$_POST[description]', '$_POST[keywords]', '$_POST[linkText]', '$_POST[title]', '$_POST[url]')";
			if (mysql_query($sql))
			{
				echo "Table news created successfully";
  }
else
  {
  echo "Error creating table: " . mysql_error();
  }
?>