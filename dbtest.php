<?php 
include "DB.php";
echo "connect";
$configsettings = parse_ini_file("gjconfig.ini");

foreach($configsettings as $key => $value)
{
	print "key : ".$key."      ".$value."<br />";
}
print "<p>*********************</p>";

// data source name or data connection string
$dsn = "mysql://netboffi:l2315793014@localhost/netboffi_goject";

// connect and create data base handle
$dbh = DB::connect($dsn);
// get errors
if(DB::isError($dbh)){
	
	die($dbh->getMessage());
	
}
// query string
$query = "select * from account";
// run query and return a 
$sth = $dbh->query($query);

while($row = $sth->fetchRow()){
	print $row[0]."    ".$row[1]."      ".$row[2]."        ".$row[3]."        ".$row[4].""."<br />";
}









?>