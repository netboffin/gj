<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registration Form for Protoplan</title> 
        
        <link rel="stylesheet" href="goject.css" type="text/css"/>      
</head>
    <body>
    <?php 
    	print_r(PDO::getAvailableDrivers());
    ?> 
	<h1>Goject Project Management Registration</h1>
<?php
if(isset($_POST["stage"])  and  ($_POST["stage"] == "process")){
	/* If I wanted to use objects I could create a new validation object and a new registration
	 * Object then validate the 
	 */
	process_form();
}else
{
		display_form();
}
function  process_form(){
	
	$username = addslashes($_POST["username"]);
	$email = addslashes($_POST["email"]);
	$passwrd = addslashes($_POST["password"]);
	$password_confirmation = addslashes($_POST["password_confirmation"]);
			
	if($passwrd == $password_confirmation)
	{
		$conn = mysql_connect("localhost","netboffi_goject","l2315793014") or die("Can't Connect : ".mysql_error());
		if($conn)
		{
			$salt ="Mick";
			$passwordAndSalt = $passwrd . $salt;
			$hash = md5($passwordAndSalt);
			$db_selected = mysql_select_db("netboffi_goject") or die("Can't connect to goject :".mysql_error());
			$query = "insert into account values(NULL,'$username','$email','$hash',false,NOW())";
			$result = mysql_query($query) or die("Query failed".mysql_error());	
			print "Account Registered. We sent you an email. Please click on the link in the email to verify your account.";
			mysql_close();			
		}
		sendVerificationEmail($username,$email,$passwrd,$hash);
		
	}else 
	{
		print "Password and password confirmation not the same.";
		print "  $passwrd"."   ".$password_confirmation; 
	}
}
function display_form(){
        ?>    
        <form name="login_form" id="login_form" action='login.php' method="post">
	    <p><label for="username"> Username : </label> <input id="username" type="text" name ="username"/></p>
        <p><label for="password"> Password : </label><input type="password" name="password"/>
        	<a href="password_reminder.php">Lost your password</a>
        	
        </p>
        <!-- <input type ="hidden" value="<?=$token?>" /> -->
		<input type="hidden" name="stage" value="process"/>
		<p><input type="submit" value ="Log In"/></p>
        </form>   
        
		<form name="Registration_Form" id="registration_form" action='<?=$_SERVER["PHP_SELF"]?>' method="post">
	    <p><label for="username">Username : </label> <input id="username" type="text" name ="username"/></p>
        <p> <label for="email">Email : </label> <input id="email" type="text" name="email"/></p>
        <p> <label for="password">Password : </label><input type="password" name="password"/></p>
        <p><label for="password_confirmation">Confirm Password :</label> <input type ="password" name ="password_confirmation"/></p>
       	<input type="hidden" name="stage" value="process"/>			
        <p><input type="submit" value ="Sign Up!"/></p>
        </form>
      
<?php
	}
?>
        <?php
function sendVerificationEmail($username,$email,$password,$hash){  
    $to      = $email; // Send email to our user  
    $subject = 'Goject Signup | Verification'; // Give the email a subject  
    $message = ' 
     
    Thanks for signing up! 
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
     
    ------------------------ 
    Username: '.$username.' 
    Password: '.$password.' 
    ------------------------ 
     
    Please click this link to activate your account: 
     
    http://www.netboffin.co.uk/gj/verify.php?username='.$username.'&hash='.$hash
     
    ; // Our message above including the link  
      
    $headers = 'From:admin@goject.com' . "\r\n"; // Set from headers  
    mail($to, $subject, $message, $headers); // Send our email  
      } 
?>
    </body>
</html>
