<?php 
	session_start();
        require "../db.php";

?>
<?php
	if(isset($_POST["logout"])){
		session_destroy();
		session_unset();
		header("LOCATION: ../index.php");
	}

	if(isset($_POST["edit"])){
		header("LOCATION: ../editpage.php");
	}
      
        if(isset($_POST["sendsearch"])){
                $_SESSION["searchterm"] = $_POST["searchterm"];
                header("LOCATION: ../search.php");
                return;
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Categories - Templates - Tech Terms</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        
    </head>
    <body>
        <header>
            <h1 id="title">Tech Terms</h1>
            <div id="navbar">
                <button type="button" class="navbutton"><a href="../index.php">Home</a></button> <!-- change buttons to onclick when JS/php is integrated -H-->
                <button type="button" class="navbutton"><a href="../pagelist.php">All Pages</a></button>
                
                <select type ="button" class="navbutton" name="categories" placeholder="Categories" onchange="
                    if(this.value == 3) {
                        window.location.href = '../categories/events.php';
                    } else if (this.value == 2){
                        window.location.href = '../categories/locations.php';
                    } else if (this.value == 1){
                        window.location.href = '../categories/terms.php';
                    }else if (this.value == 0){
			window.location.href = '../categories/categories.php';
		    }
                ">
                    <option value="-1">Select Category</option>
                    <option value="0">Categories</option>
                    <option value="1">Terms</option>
                    <option value="2">Locations</option>
                    <option value="3">Events</option>
                </select> <!-- end of dropdown -->
                
                <button onclick= "randomURL()" type="button" class="navbutton">Random</button>
                <script>
                    function randomURL(){
                        var arrayOfSites = ["../articles/EatsHit.php", "../articles/WalkerPool.php", "../articles/kday.php", "../articles/Econo.php"];
                        var randomSite = arrayOfSites[Math.floor(Math.random() * arrayOfSites.length)];
                        window.location.replace(randomSite);
                    }
                </script>

                <div class="navbutton" style="padding:0px;border-width:0px;">
                	<form method="post" action="../index.php">
                    	<input type="text" class="navbutton" id="searchbar" name="searchterm" placeholder="Search..."><input type="submit" name="sendsearch" class="navbutton" value="&rArr;">
                    	<!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
               		</form>
                </div>

		<?php
                	if(isset($_SESSION["username"])){
				?> 
				<form method="post" action="../index.php" class="form-test">
					<button type="submit" name="logout" class="navbutton">Log Out</Button>
					<button type="submit" name="edit" class="navbutton">Edit Pages</Button>
				</form>
				<?php
			}else{
				?>
				<button type="button" class="navbutton" id="login"><a href="../login.php">Log In</a></button> 
				<?php
			}
            	?>

            </div>
        </header>        
        
        <main>
            <div class="spacer"></div> <!-- spacer used to prevent main body from overlapping with header -H -->
            <div class="tags">
                Tags: <a href="./categories.php">Categories</a>
            </div>
            <div class="article-title">
                <h1>Templates (Category)</h1>
            </div>
            <div class="article-content"> <!-- div used to realign flexboxes at smaller sizes -H -->
                <div class="content-body">
                    <h2>About This Category</h2>
                        <p>This category contains all template pages</p>
                    <h2>List of Pages in Category</h2>
                        <li><a href="../articles/articletemplate.php">Article Template</a></li>
                        <li><a href="./categorytemplate.php">Content Template</a></li>
                </div>
            </div>
        </main>
    </body>
</html>