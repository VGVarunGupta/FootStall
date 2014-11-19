<?php
	include('Db_info.php');
?>
<?php
	mysql_connect($host,$username,$password) or die("Cannot connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$sql=
		"INSERT INTO leagues
			( League_id, League_name,Abbrevation,shortName ) 
			VALUES 	
			('$_POST[League_id]','$_POST[League_name]', '$_POST[abbrevation]','$_POST[shortName]')";
			if (mysql_query($sql))
			{
				echo "Table users created successfully";
  }
else
  {
  echo "Error creating table: " . mysql_error();
  }
?>