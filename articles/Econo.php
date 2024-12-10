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
    <!-- Connects to DB and pulls article data -L -->
    <?php
    require "/local/group_projects/cs3141/classdb/TechTerms/readDB/readDB.php";
    $id = 'Econo'; # This is the id for the article in the DB -L
    $row = getData($id);
    ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> <?php echo $row[1]; ?> - Tech Terms</title> <!-- $row[1] is the page title from DB -L-->
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
                Tags: <a href="../categories/templates.php">Templates</a>, <a href="../categories/articles.php">Articles</a> <!--Remove templates category when making page. Leave articles category. -H-->
            </div>
            <div class="article-title">
                <h1><?php echo $row[1]; ?></h1>
            </div>
            <div class="article-content"> <!-- div used to realign flexboxes at smaller sizes -H -->
                <div class="boxes"> <!-- div used to realign flexboxes at smaller sizes -H -->
                    <div class="contents"> <!--table of contents -H -->
                        <!-- 
                            These should be the list of categories we'll need. They can be omitted as fits the page. 
                            -H
                         -->
                         <li><a href="#summary">Summary</a></li>
                         <li><a href="#details">Details</a></li>
                        <li><a href="#otherinformation">Other Information</a></li>
                        <li><a href="#history">History</a></li>
                        <li><a href="#seealso">See Also</a></li>
                        <li><a href="#references">References</a></li>
                    </div>
                </div>
                <div class="content-body"> <!-- the article itself -H -->
                    
                <!-- Displays article contents pulled from DB (stored in $row[0]) -L -->
                <?php
                echo $row[0];
                ?>
                
                <!-- Use the code below as a format for the html code you would put into the DB (content attribute of pages table) -L

                    <h2 id='summary'>Summary</h2>
                    <p>Welcome to Tech Terms example article page! This is the content body. This is where the main article goes.</p>
                    <h2 id='details'>Details</h2>
                    <p>etc.</p>
                    <h2 id='otherinformation'>Other Information</h2>
                    <p>etc.</p>
                    <h2 id='history'>History</h2>
                    <p>etc.</p>
                    <h2 id='seealso'>See Also</h2>
                    <p>etc.</p>
                    <h2 id='references'>References</h2>
                    <p>etc.</p> 
                    
                    -->
                </div>
            </div>
        </main>
    </body>
</html>