<?php include('Db_info.php'); ?>
<?php
session_start();
if ($_POST)
{
$social = "Normal";
$id=$_POST['NAME'];
$date=$_POST['DATE'];
$month=$_POST['MONTH'];
$year=$_POST['YEAR'];
$email=$_POST['EMAIL'];
$pass=$_POST['PASSWORD'];
$passwords=md5($pass);
$hash = md5(rand(0,1000) );
$verify=0;
$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
mysql_select_db($db_name)or die("Cannot Select the database");
$query_email = "SELECT * FROM $table";
$result_email = mysql_query($query_email);
$email_flag = 0;
while($arr = mysql_fetch_array($result_email)){
if($arr['email'] == $email){
$email_flag = 1;
}
}
if ($email_flag == 0)
{
	$sql="INSERT INTO users (social_media, name, email, password, date, month, year, hash, verify) VALUES (\"$social\", \"$id\", \"$email\", \"$passwords\", \"$date\", \"$month\", \"$year\", \"$hash\", \"$verify\")";
if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error($con));
  }
mysql_close($con);
$_SESSION["email"]=$email;
$_SESSION["username"]=$id;
$_SESSION["password"]=$pass;
$_SESSION["hash"]=$hash;
header('Location:emailver.php');
}
else {
    $_SESSION["final"]=$email_flag;
	header('Location:checkin.php');
}
mysql_close($con);
}
?>