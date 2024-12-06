<?php

	function connectDB()
	{
		$config = parse_ini_file("db.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}

	function testLogin($user, $passwd) {
		try {
			if($user == "tester" && $passwd == "testpw"){
				return 1;
			}else{
				return 0;
			}
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}

//return number of rows matching the given user and passwd.
	function authenticate($user, $passwd) {
		try {
			$dbh = connectDB();
			$statement = $dbh->prepare("SELECT count(*) FROM lab5_customer ".
			"where username = :username and password = sha2(:passwd,256) ");
			$statement->bindParam(":username", $user);
			$statement->bindParam(":passwd", $passwd);
			$result = $statement->execute();
			$row = $statement->fetch();
			$dbh=null;
			return $row[0];
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}

//Return page info if content columns contain provided search term -H
	/*function search($searchterm){
		try{
			$dbh = connectDB();
			//TODO: FOLLOWING LINE WILL NEED TO CHANGE TO FIT TABLE SPECIFICS AND BE DEBUGGED ONCE CREATED. -H
			$statement = $dbh->prepare("SELECT id, title, path FROM pages WHERE (title, summary, details, history, see_also, refs, gallery, other) LIKE %:searchterm% ") //Select id of pages where "[searchterm]" appears at any point in the page's content. Todo: expand coverage to categories, separate words in searchterm so they don't have to be in specific order. -H
			$statement->execute();
	
			return $statement->FetchAll();
			$dbh = NULL;
		}else{
			print("Error!" . $e->getMessage() . "<br/"); //Can be replaced by something nicer -H
			die();
		}
	} */
?>
