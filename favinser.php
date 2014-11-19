<?php include('Db_info.php'); ?>
<?php
session_start();
if ($_POST)
{
	$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$sql=mysql_query("Select * from users");
	if($row = mysql_fetch_array($sql))
	{ 
		if ($row['email']==$_SESSION['email'])
		{
			$F1=$_POST['FAVT1'];
			$F2=$_POST['FAVT2'];
			$F3=$_POST['FAVL'];
			$F4=$_POST['FAVC'];
			$que="UPDATE `users` SET `choice_ver`=1, `Favt1`= \"$F1\", `Favt2` = \"$F2\", `Favl` = \"$F3\", `Favc` = \"$F4\" WHERE `email`=\"$row[email]\";";
			$_SESSION['favt1']=$F1;
			$_SESSION['favt2']=$F2;
			$_SESSION['favl']=$F3;
			$_SESSION['favc']=$F4;
			mysql_query($que);
			header("Location: home.php");
		}
		else 
		{
			header("Location: checkin.php");
		}
	}
}
?>