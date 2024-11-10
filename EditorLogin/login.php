<?php
	require "db.php";
	session_start();
?>
<?php
	if(isset($_POST["logout"])){
		session_destroy();
	}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tech Terms Login Page</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        
    </head>
	<body>
		<header>
        	<h1 id="title">Tech Terms</h1>
            	<div id="navbar">
           	     	<button type="button" class="navbutton"><a href="../indexx.php">Home</a></button> <!-- change buttons to onclick when JS/php is integrated -H-->
                	<button type="button" class="navbutton"><a href="../pagelist.html">All Pages</a></button>
               		<form method="get" action="search.php">
                    	<select type="button" class="navbutton" name="categories" placeholder="Categories">
                        	<option>Categories</option><!--go to list of categories -H-->
                        	<option>Terms</option>
                	        <option>Locations</option>
        	                <option>Events</option>
	                    </select> <!-- Need to go to page on click (form submit + script go to link on option select) -H-->
	                </form>
                	<button type="button" class="navbutton">Random</button>
                	<div class="navbutton" style="padding:0px;border-width:0px;">
                   		<input type="text" class="navbutton" id="searchbar" name="searchbar" placeholder="Search..."><input type="submit" class="navbutton" value="&rArr;">
                    		<!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
                	</div>
                	<button type="button" class="navbutton" id="login">Log In</button>
            		</div>
        	</header>
		<main>
		<div class="spacer"></div>
		<div class="login-boxes">
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
			<label for="uname">username: </label>
			<input type="text" id="uname" name="username"><br>
			<label for="pword">password: </label>
			<input type="text" id="pword" name="password"><br>
			<button type="submit" name="login">login</button>	
		</form>
	<?php
		if(isset($_POST["login"])){
			if (authenticate($_POST["username"], $_POST["password"]) ==1) {
				$_SESSION["username"]=$_POST["username"];
				header("LOCATION:main.php");
				return;
			}else{
				echo '<p style="color:red">incorrect username and password</p>';
			}
		}
	?>
		</div>
		</main>
	</body>
</html>