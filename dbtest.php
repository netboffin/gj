<?php 
/****** Using Pear DB ***********/
/*include "DB.php";
echo "connect";
$configsettings = parse_ini_file("gjconfig.ini");

foreach($configsettings as $key => $value)
{
	print "key : ".$key."      ".$value."<br />";
}
print "<p>*********************</p>";

// data source name or data connection string
$dsn = "mysql://".$configsettings["username"].":".$configsettings['password']."@localhost/netboffi_goject";

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
}*/

/********** End of using PEAR DB *****************/

/********** use account model with PDO *****************/
include "db.php";
include "account_model.php";

$db = new account_model();
for($i=1;$i=<10;$i++)
{
	$accounts = $db->load($i);//load could return more than one record
	foreach($accounts as $key=>$account){
		echo "$i :".$account["AccountUsername"]."<br />";
	}
}




?>