<?php
class db{
	
	protected static $dbh = false;
		
	function connect(){
		$settings = parse_ini_file("gjconfig.ini");
				
		$dbhost = $settings["dbhost"];
		$dbname = $settings["dbname"];
		$dbusername = $settings["dbusername"];
		$dbpassword = $settings["dbpassword"];
		try{
		self::$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e)
		{
			echo "I'm sorry, Dave. I'm afraid I can't do that.";  
   			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
			print $e->getMessage();
		}
		
	}    

    	/*
    	 * The database handle $dbh is declared as static so we can connect to a database without instantiating a 
			new database object we can do 

			db::$dbh
 
		rather than :
			$db = new db();
			$db->connect();
    	*/
    	
}
?>

  

