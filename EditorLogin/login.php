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
                	<form method="get" action="search.php" class="form-test">
                    		<select type ="button" class="navbutton" name="categories" placeholder="Categories" onchange="
                    		if(this.value == 3) {
                        		window.location.href = '../categories/events.html';
                    		} else if (this.value == 2){
                  		      	window.location.href = '../categories/locations.html';
                    		} else if (this.value == 1){
                        		window.location.href = '../categories/terms.html';
                    		}
                		">
                    			<option value="0" >Categories</option>
                    			<option value="1" >Terms</option>
                		    	<option value="2" >Locations</option>
                    			<option value="3" >Events</option>
                		</select> <!-- end of dropdown -->
                	</form>
                	<button type="button" class="navbutton">Random</button>
                	<div class="navbutton" style="padding:0px;border-width:0px;">
                    		<input type="text" class="navbutton" id="searchbar" name="searchbar" placeholder="Search..."><input type="submit" class="submit-button" value="&rArr;">
                    		<!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
                	</div>
			<?php
                		if(isset($SESSION["username"])){
					?> <button type="button" class="navbutton" id="login"><a href="./EditorLogin/login.php">Log Out</a></button> <?php
				}else{
					?> <button type="button" class="navbutton" id="login"><a href="./EditorLogin/login.php">Log In</a></button> <?php
				}
            		?>
			</div>	
        	</header>
		<main>
		<div class="spacer"></div>
		<div style="display: grid; place-items: center; min-height: 50vh; align-items: right;">
		<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
			<label for="uname" style="font-size: 30px;">Username:     </label>
			<input type="text" id="uname" name="username" style="height: 30px;" autocomplete="one-time-code"><br>
			<label for="pword" style="font-size: 30px">Password:  	 </label>
			<input type="password" id="pword" name="password" style="height: 30px; margin-left: 8px" autocomplete="one-time-code"><br>
			<button type="submit" name="login">login</button>	
		</form>
	<?php
		if(isset($_POST["login"])){
			if (testLogin($_POST["username"], $_POST["password"]) ==1) {
				$_SESSION["username"] = $_POST["username"];
				header("LOCATION:../indexx.php");
				return;
			}else{
				echo '<p style="color:red; ">incorrect username and password</p>';
			}
		}
	?>
		</div>
		</main>
	</body>
</html>
