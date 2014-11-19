<?php 
include("Db_info.php");
mysql_connect("$host","$username", "$password")or die("Cannot Connect to the DB");
mysql_select_db("$db_name")or die("Cannot select the DB");
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{  
    $email = mysql_escape_string($_GET['email']);
    $hash = mysql_escape_string($_GET['hash']);
                  
    $search = mysql_query("SELECT email, hash, verify FROM $table WHERE email='".$email."' AND hash='".$hash."' AND verify='0'") or die(mysql_error());   
    $match  = mysql_num_rows($search);  
                  
    if($match > 0)
	{  
        mysql_query("UPDATE $table SET verify='1' WHERE email='".$email."' AND hash='".$hash."' AND verify='0'") or die(mysql_error());  
        header('Location:success.php');
    }
	else{    
        echo "The url is either invalid or you already have activated your account";  
    }             
}
else{  
    echo "Invalid approach, please use the link that has been sent to your email.";  
} 
?>