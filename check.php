<?php
	include('Db_info.php');
?>
<?php
		mysql_connect($host,$username,$password) or die("Cannot connect to database");
		mysql_select_db($db_name)or die("Cannot Select the database");
		$email = mysql_real_escape_string($_POST['EMAIL2']);
		$pwd = md5(mysql_real_escape_string($_POST['PASSWORD2']));
		$sql = mysql_query(" 
							SELECT * FROM users WHERE 
							email='$email' AND 
							password='$pwd'
							"); 
		if(mysql_num_rows($sql) == 1)
			{ 
				$row = mysql_fetch_array($sql); 
				if ($row['verify']==1)
				{
					session_start();
					$_SESSION['log']=1;
					$name1 = $row['name'];
					$name2 = explode(" ",$name1);
					$_SESSION['name'] = $name2[0];
					$_SESSION['email'] = $row['email'];
					if ($row['choice_ver']==0)
						header("Location: fav.php");  //have to enter the url i want to direct it to
					else
					{
						$_SESSION['favt1']=$row['Favt1'];
						$_SESSION['favt2']=$row['Favt2'];
						$_SESSION['favl']=$row['Favl'];
						$_SESSION['favc']=$row['Favc'];
						header("Location: home.php");  //have to enter the url i want to direct it to
					}
					exit;
				}
				else
				{
					session_start(); 
					$_SESSION['log'] = 2; 
					header("Location: checkin.php");
					exit;
				}
			}
		else
			{	
				session_start(); 
				$_SESSION['log'] = 0; 
				header("Location: checkin.php");
				exit;
			}
?>