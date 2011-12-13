<?php 
	// Get the email and hash from the url
	$email = addslashes($_GET["email"]);
	$hash  = addslashes($_GET["hash"]);
	echo "before connection";
	// Connect to the database
	
	$db = mysql_connect("localhost","netboffi","l2315793014") or die("Connection failed : ".mysql_error());
	echo "after connection";
	$db_selected = mysql_select_db("netboffi_goject") or die("Mysql_select_db not working :".mysql_error());
	echo "after select_db";
	$email = mysql_escape_string($email);
	
	$query = "update account set AccountVerified = true where AccountEmail = '$email' and AccountPasswrd='$hash'";
	$result = mysql_query($query)or die("Query returned : ".mysql_error());
	mysql_close($db);
	echo "Congratulations your account has been registered";
	
?>