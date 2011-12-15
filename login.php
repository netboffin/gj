<?php
	$username = $_POST['username'];
	$passwrd = $_POST['password'];
	$salt ="Mick";
	$passwordAndSalt = $passwrd . $salt;
	$hash = md5($passwordAndSalt);
	$conn = mysql_connect("localhost","netboffi_goject","l2315793014") or die("No connection".mysql_error());
	mysql_select_db("netboffi_goject");
	$query = "select * from account where AccountUsername = '$username' and AccountPasswrd = '$hash'";
	$result = mysql_query($query)or die("query didn't work".mysql_error());
	
	if(mysql_num_rows($result) == 0)
	{
		print "No user with this username: $username and password $passwrd";
	}
	
	$row = mysql_fetch_array($result);
	if($row["AccountVerified"])
	{
		print "<p>".$row["AccountVerified"]."</p>";
		print "This account is verified, you are now logged in";
	} else 
	{
		print "<p>".$row['AccountVerified']."</p>";
		print "This account is not verified yet, so you need to find the email we sent you and click the link";
	}
	print_r($row);			
?>