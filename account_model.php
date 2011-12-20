<?php
class account_model extends db{
	
	// Noticeable that we can't see the database handle 
	// dbh which is declared in db
   	function insert($account){
   	   	 try {
    	  if(!self::$dbh) $this->connect();
      		$stmt = self::$dbh->prepare("INSERT INTO accounts 
                                    (AccountID,
                                    AccountUsername,
                                    AccountEmail,
                                    AccountPasswrd,
                                    AccountVerified,
                                    AccountCreationDate,
                                    AccountSecurityQuestionSet,
                                    AccountSecurityQuestion)
                                   	VALUES 
                                    (NULL,
                                    :AccountUsername,
                                    :AccountEmail,
                                    :AccountPasswrd,
                                    :AccountVerified,
                                    :AccountCreationDate,
                                    :AccountSecurityQuestionSet,
                                    :AccountSecurityQuestion)");
      		$params = array(':AccountID'  =>$account['AccountID'],
                      ':AccountUsername'=>$account['AccountUsername'],
                      ':AccountEmail'=>$account['AccountEmail'],
                      ':AccountPasswrd'=>$account['AccountPasswrd'],
      				  ':AccountVerified'=>$account['AccountVerified'],
      				  ':AccountCreationDate'=>$account['AccountCreationDate'],
      				  ':AccountSecurityQuestionSet'=>$account['AccountSecurityQuestionSet'],
      				  ':AccountSecurityQuestion'=>$account['AccountSecurityQuestion']      		
      		);
      		$ret = $stmt->execute($params);
    	} catch (PDOException $e) {
      		//$this->fatal_error($e->getMessage());
      		print $e->getMessage();
    	}
   		
   		
/*
   Field              | Type        | Null  | Key | Default | Extra          | 
| AccountID           | int(11)      | NO   | PRI | NULL    | auto_increment |
| AccountUsername     | varchar(100) | NO   |     | NULL    |                |
| AccountEmail        | varchar(100) | NO   |     | NULL    |                |
| AccountPasswrd      | varchar(64)  | NO   |     | NULL    |                |
| AccountVerified     | tinyint(1)   | NO   |     | 0       |                |
| AccountCreationDate | datetime     | NO   |     | NULL    |                | 
| AccountSecurityQuestionSet |tinyint(1)|NO |     | 0		|				 |
| AccountSecurityQuestion    |text(75)  |NO |     | ''      |   		     |
   		
 */  		
 }
   	function modify($account){
   		 try {
      if(!self::$dbh) $this->connect();
      $stmt = self::$dbh->prepare("UPDATE account SET 
      		      AccountID=:AccountID,
            	  AccountUsername=:AccountUsername,
                  AccountEmail=:AccountEmail,
                  AccountPasswrd=:AccountPasswrd,
      			  AccountVerified=:AccountVerified,
      			  AccountCreationDate=:AccountCreationDate,
      			  AccountSecurityQuestionSet=:AccountSecurityQuestionSet,
      			  AccountSecurityQuestion=:AccountSecurityQuestion   
                  WHERE AccountID=:id");
     
      $params = array(':AccountID'  =>$account['AccountID'],
                      ':AccountUsername'=>$account['AccountUsername'],
                      ':AccountEmail'=>$account['AccountEmail'],
                      ':AccountPasswrd'=>$account['AccountPasswrd'],
      				  ':AccountVerified'=>$account['AccountVerified'],
      				  ':AccountCreationDate'=>$account['AccountCreationDate'],
      				  ':AccountSecurityQuestionSet'=>$account['AccountSecurityQuestionSet'],
      				  ':AccountSecurityQuestion'=>$account['AccountSecurityQuestion']      		
      		);
      
      
      
      
      $ret = $stmt->execute($params);
    } catch (PDOException $e) {
      $this->fatal_error($e->getMessage());
    }
    return $ret;
   		
   		
   	}
   	
   	function load($id=-1){
   		//id could be any row here so we could be returning any number of rows.
	   	$where = '';

    	if($id!=-1) $where = "where AccountID=".(int)$id;
    	try {
      		if(!self::$dbh) $this->connect();
      		$result = self::$dbh->query("SELECT * FROM account $where");
      		$rows = $result->fetchAll(PDO::FETCH_ASSOC); 
    	} catch (PDOException $e) {
      		//$this->fatal_error($e->getMessage());
      		print $e->getMessage();
    	}
    // Some databases can do this right in the SELECT
    // SQLite can't, so we add a formatted column ourselves
    foreach($rows as $i=>$row) {
     // $rows[$i]['fprice'] = number_format($row['price'],2);
     
    }
    return $rows;
  }
   		
   		
   		
   		
  
   	
   	/* We have to create accounts at registration
   	 * read accounts to check that they exist password_reminder
   	 * read accounts to see if they are verified at login
   	 * read accounts 
   	 * 
   	 * update an account when the email is verified
   	 * update an account when user forgets their password
   	 * 
   	 */
   	/* 5 hours analysis design coding:2 hours reading:1 hour process */
}
?>