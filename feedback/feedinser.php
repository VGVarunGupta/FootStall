<?php include('../Db_info.php'); ?>
<?php
session_start();
if ($_POST)
{
$name=$_POST['NAME'];
$email=$_POST['EMAIL'];
$feed=$_POST['FEEDBACK'];
$con = mysql_connect($host,$username,$password)or die("Cannot Connect to database");
mysql_select_db($db_name)or die("Cannot Select the database");
$sql="INSERT INTO feedback (name, email, feedback) VALUES (\"$name\", \"$email\", \"$feed\")";
if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error($con));
  }
$_SESSION['dis']="Your Feedback has been sent";
header('Location:index.php');
mysql_close($con);
}
?>