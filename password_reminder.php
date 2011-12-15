<!DOCTYPE HTML>
<html>
<head><title>Goject Password Reminder</title></head>
<body>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="text" name="usernameoremail"/>
<input type="hidden" name="stage" value="process"/>
<input type="submit" value="Get New Password"/>
</form>
<a href="login.php">Log In</a>
<a href="index.php">Back to home page</a>
</body>
</html>