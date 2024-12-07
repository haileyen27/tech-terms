<?php

// Connects to the Database using the credentials in readDB.ini
function connectDB()
	{
		$config = parse_ini_file("readDB.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}

    // Gets content and name from DB that matches the given ID.
function getData($id) {
    try {
        $db = connectDB();
        $statement = $db->prepare("SELECT content, name FROM pages ".
        "WHERE id = :id");
        $statement->bindParam(":id", $id);
        $result = $statement->execute();
        $row = $statement->fetch();
        $db=null;

        return $row;
        }catch (PDOException $e) {
            print "Error!" . $e->getMessage() . "<br/>";
            die();
        } 

}
?>