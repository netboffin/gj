<!DOCTYPE HTML>
<html>
<head><title>Goject Password Reminder</title></head>
<body>


<?php 
if(isset($_POST["stage"]) && ($_POST["stage"]=='process'))
{
	process_password_reset_form();
}else 
{
	display_form();
}
function display_form(){
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="usernameoremail"/>
<input type="hidden" name="stage" value="process"/>
<input type="submit" value="Get New Password"/>
</form>
<?php 
}
function process_password_reset_form(){
	$usernameoremail = $_POST["usernameoremail"];
	//connect to database
	mysql_connect("localhost","netboffi","l2315793014");
	mysql_select_db("netboffi_goject");
	$query = "select * from account where AccountUsername = '$usernameoremail' or AccountEmail = '$usernameoremail'";
	$result = mysql_query($query);
	var_dump($result);
	if(($rows = mysql_fetch_array($result))>0)
	{
		print_r($rows);
		$emailAddress = $rows["AccountEmail"];
		$new_password = md5(uniqid(rand(),TRUE));
		$salt = "Mick";
		$passwordandhash = $new_password.$salt;
		$hash = md5($passwordandhash);
		$query2 = "update account set AccountPassword = '$hash'";		
		mysql_query($query2)or die("<p>Couldn't update account password ".mysql_error());
		mail($emailAddress,"Password Reset Here's your new password",$new_password);
		print "Your new password has been sent to".$emailAddress;
	}	
}

?>
<a href="login.php">Log In</a><br />
<a href="index.php">Back to home page</a>
</body>
</html>
