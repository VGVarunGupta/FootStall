<?php
	include('Db_info.php');
?>
<?php
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$sql=
		"INSERT INTO Players
			( Player_id, firstName,lastName,shortName,fullName,league_id ) 
			VALUES 	
			('$_POST[Player_id]','$_POST[firstName]', '$_POST[lastName]','$_POST[shortName]','$_POST[fullName]','$_POST[league_id]')";
			if (mysql_query($sql))
			{
				echo "Table users created successfully";
  }
else
  {
  echo "Error creating table: " . mysql_error();
  }
?>