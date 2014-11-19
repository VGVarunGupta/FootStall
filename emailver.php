<?php
session_start();
$flag = 1;
if(isset($_SESSION["email"]))
{
    $flag = 0;
    $user 	 = $_SESSION["username"];
    $hash	 = $_SESSION["hash"];
    $to      = $_SESSION["email"];  
    $subject = 'FootStall | Verification';   
    $message ='
    <font face = "Calibri" size = "5" color = #5491ae>FootStall<div>&nbsp;</div><div>&nbsp;</div></font>
    <font face = "Calibri" size = "3">
    <div>
    Hi '.$user.',<div>&nbsp;</div>
        </div>
        <div>
	Click here to confirm your email address and finish creating the FootStall account:
        </div>
        http://www.fundartica.in/footstall/email.php?email='.$to.'&hash='.$hash.'
	<div><div>&nbsp;</div>
	Thank you for your interest in FootStall!
	</div>
        <div>
        <div>&nbsp;</div>
	--Team FootStall
        </div>
        <div>
	http://www.fundartica.in/footstall/
        </div>
        <div>
        <img src="http://www.fundartica.in/footstall/images/logo.png" align = "center" width="150px" height="75px">
        </div>
    ';  
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";                      
    $headers .= 'From:no-reply@footstall.in' . "\r\n"; 
    mail($to, $subject, $message, $headers);
}
$_SESSION["flag"] = $flag;
header('Location:checkin.php');
?>