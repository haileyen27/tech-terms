<!DOCTYPE html>
<?php 
	session_start();
        require "db.php";

?>
<?php
	if(isset($_POST["logout"])){
		session_destroy();
		session_unset();
		header("LOCATION: index.php");
	}

	if(isset($_POST["edit"])){
		header("LOCATION: editpage.php");
	}
      
        if(isset($_POST["sendsearch"])){
                $_SESSION["searchterm"] = $_POST["searchterm"];
                header("LOCATION:./search.php");
                return;
        }

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tech Terms Homepage</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        
    </head>
    <body>
        <header>
            <h1 id="title">Tech Terms</h1>
            <div id="navbar">
                <button type="button" class="navbutton"><a href="./index.php">Home</a></button> <!-- change buttons to onclick when JS/php is integrated -H-->
                <button type="button" class="navbutton"><a href="./pagelist.html">All Pages</a></button>
                
                <select type ="button" class="navbutton" name="categories" placeholder="Categories" onchange="
                    if(this.value == 3) {
                        window.location.href = './categories/events.html';
                    } else if (this.value == 2){
                        window.location.href = './categories/locations.html';
                    } else if (this.value == 1){
                        window.location.href = './categories/terms.html';
                    }
                ">
                    <option value="0">Categories</option>
                    <option value="1">Terms</option>
                    <option value="2">Locations</option>
                    <option value="3">Events</option>
                </select> <!-- end of dropdown -->
                
                <button onclick= "randomURL()" type="button" class="navbutton">Random</button>
                <script>
                    function randomURL(){
                        var arrayOfSites = ["./articles/EatsHit.html", "./articles/WalkerPool.html"];
                        var randomSite = arrayOfSites[Math.floor(Math.random() * arrayOfSites.length)];
                        window.location.replace(randomSite);
                    }
                </script>

                <div class="navbutton" style="padding:0px;border-width:0px;">
                	<form method="post" action="index.php">
                    	<input type="text" class="navbutton" id="searchbar" name="searchterm" placeholder="Search..."><input type="submit" name="sendsearch" class="navbutton" value="&rArr;">
                    	<!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
               		</form>
                </div>

		<?php
                	if(isset($_SESSION["username"])){
				?> 
				<form method="post" action="index.php" class="form-test">
					<button type="submit" name="logout" class="navbutton">Log Out</Button>
					<button type="submit" name="edit" class="navbutton">Edit Pages</Button>
				</form>
				<?php
			}else{
				?>
				<button type="button" class="navbutton" id="login"><a href="./login.php">Log In</a></button> 
				<?php
			}
            	?>

            </div>
        </header>
        
        <main>
            <div class="spacer"></div>
	    <div>
		<form method="post" action="./editpage.php">
			<select type="button" class="navbutton" name="pages" id="pages"> 
				<option value="">Choose an article</option>
			<?php
				$hold = getPages();
				foreach($hold as $pages){
			?>	
				<option value="<?php echo $pages[0] ?>" name="pageToEdit"><?php echo $pages[1]?></option>
			<?php }
			?>
			</select>
			<button type="submit" class="navbutton" name="choosePage">Edit Page</button>
		</form>
		<?php	
		if(isset($_POST["choosePage"])&&($_POST["pages"] != "")){
			$pageId = $_POST["pages"];
			echo '<p style="">    Currently Editing: ' . $pageId . '</p>';
			$_SESSION["pageId"] = $_POST["pages"];
			$pageData = getPageData($pageId);
			//echo $pageData;
		?>
		<form method="post" action="./editpage.php">
			<textarea type="textarea" class="navbutton" id="pageContent" name="pageContent" style="height:1000px; width:1200px; padding:10px; rows: 300; columns: 200"><?php
			if(isset($pageData)){
				echo $pageData;
			}else{
				echo "Nothing yet...";
			}
			?></textarea>
			</br>
			<button type="submit" class="navbutton" name="submitChange">Submit Change</button>	
		</form>
		<?php
		}	
		if(isset($_POST["submitChange"])){
			echo '<p style="">    Changed  ' . $_SESSION["pageId"] . '</p>';
			setPageData($_SESSION["pageId"], $_POST["pageContent"]);
		}
		?>
	    </div>

        </main>
        <footer>
            <p>Copyright [team] 2024</p>
        </footer>
        
    </body>


</html>