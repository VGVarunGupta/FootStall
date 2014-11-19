<?php include('Db_info.php');
session_start();
if ($_POST) 
{
	$social = $_POST['SOCIAL'];;
	$id=$_POST['NAME'];
	$email=$_POST['EMAIL'];
	$date=$_POST['DATE'];
	$month=$_POST['MONTH'];
	$year=$_POST['YEAR'];
	$verify=1;
	$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
	mysql_select_db($db_name)or die("Cannot Select the database");
	$query_email = "SELECT * FROM $table";
	$result_email = mysql_query($query_email);
	$email_flag = 0;
	while($arr = mysql_fetch_array($result_email)){
		  if($arr['email'] == $email){
				$email_flag = 1;
				$_SESSION['log'] = 1;
				$name1 = $arr['name'];
				$name2 = explode(" ","Varun Gupta");
				echo($name2[0]);
				$_SESSION['name'] = $name2[0];
		  }
	}
	if ($email_flag == 0)
	{
		$sql="INSERT INTO users (social_media, name, email, date, month, year, verify) VALUES (\"$social\", \"$id\", \"$email\", \"$date\", \"$month\", \"$year\", \"$verify\")";
		if (!mysql_query($sql))
		{
			die('Error: ' . mysql_error($con));
		}
		header("Location: successfb.php");
	}
	else if ($email_flag == 1)
	{
		header("Location: home.php");
	}
	else 
	{
		echo "2";
	}
	mysql_close($con);
}
?>