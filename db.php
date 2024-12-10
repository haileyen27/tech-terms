<?php

	function connectDB()
	{
		$config = parse_ini_file("db.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		
		//$user = "techterms_rw";
		//$pass = "T3chT3rms!";
		//$dbh = new PDO('mysql:host=classdb.it.mtu.edu;dbname=techterms', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
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
	function authenticate($user, $pwd) {
		try {
			$dbh = connectDB();
			$statement = $dbh->prepare("SELECT count(*) FROM users ".
			"where name = :username and password = sha2(:pass,256) ");
			$statement->bindParam(":username", $user);
			$statement->bindParam(":pass", $pwd);
			$result = $statement->execute();
			$row = $statement->fetch();
			$dbh=null;
			return $row[0];
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}

//get the database page names
	function getPages() {
		try {
			$dbh = connectDB();
			$statement = $dbh->prepare("SELECT id, name FROM pages ");
			$result = $statement->execute();
			$row = $statement->fetchAll();
			$dbh=null;
			return $row;
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}

//get the database page contents
	function getPageData($pageId) {
		try {
			$dbh = connectDB();
			$statement = $dbh->prepare("SELECT content, count(*) FROM pages where id = :page");
			$statement->bindParam(":page", $pageId);
			$result = $statement->execute();
			$row = $statement->fetch();
			$dbh=null;
			if($row[1] == 1){
				return $row[0];
			}else{
				return "Error: Wrong number of page count";
			}
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}
//applies the changes to the database	
	function setPageData($pageId, $newData) {
		try {
			$dbh = connectDB();
			$statement = $dbh->prepare("update pages set content = :newContent where id = :Id; ");
			$statement->bindParam(":Id", $pageId);
			$statement->bindParam(":newContent", $newData);
			$statement->execute();
			return;
		}catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		}
	}


//Return page info if content columns contain provided search term -H
	function search($searchterm){
		try{
			$dbg = NULL;
			$dbh = connectDB();
			$searchterm = $_SESSION["searchterm"];
			$s = NULL;
			//print("!!!!!!!!!!!!!");
			
			//$statement = $dbh->prepare("SELECT id, name, pathFromRoot FROM pages WHERE content LIKE '%".$_SESSION["searchterm"]."%';"); //INSECURE //Select id of pages where "[searchterm]" appears at any point in the page's content. Todo: expand coverage to categories, separate words in searchterm so they don't have to be in specific order. -H
			$s = $dbh->prepare("SELECT id, name, pathFromRoot FROM pages WHERE content LIKE :search ;"); //Select id of pages where "[searchterm]" appears at any point in the page's content. Todo: expand coverage to categories, separate words in searchterm so they don't have to be in specific order. -H
			
			$s->bindValue(":search",'%' . $_SESSION["searchterm"] . '%');
			//print($s->debugDumpParams()."</br>");
			//print($searchstring);
			$s->execute();
			
			return $s->FetchAll();
			$dbh = NULL;
		}catch(PDOException $e){
			print ("Error! " . $e->getMessage() . "<br/"); //Can be replaced by something nicer -H
			die();
		}
	} 
?>