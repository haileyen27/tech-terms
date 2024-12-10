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
                <button type="button" class="navbutton"><a href="./pagelist.php">All Pages</a></button>
                
                <select type ="button" class="navbutton" name="categories" placeholder="Categories" onchange="
                    if(this.value == 3) {
                        window.location.href = './categories/events.php';
                    } else if (this.value == 2){
                        window.location.href = './categories/locations.php';
                    } else if (this.value == 1){
                        window.location.href = './categories/terms.php';
                    }else if (this.value == 0){
			window.location.href = './categories/categories.php';
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
                        var arrayOfSites = ["./articles/EatsHit.php", "./articles/WalkerPool.php", "./articles/kday.php", "./articles/Econo.php"];
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

                <?php
                    if(isset($_POST["sendsearch"])){
                        $_SESSION["searchterm"] = $_POST["searchterm"];
                        header("LOCATION:./search.php");
                        return;
                    }

                ?>
            </div>
        </header>
        
        <main>
            <div class="spacer"></div>
            <div class="about-body">

                <h2>Welcome <?php if(isset($_SESSION["username"])) {echo $_SESSION["username"];} ?> </h2>
                <p>Welcome to Tech Terms home page! The buttons above will help you navigate the site. Home will take you to this page, categories will take you to the list of different term categories, random will bring you to a random term page, and the searchbar is for looking up specific terms. The log in button is for editors to access editing tools.</p>

                <h2>About</h2>
                <p>Tech Terms is a wiki for all sorts of terms, slang, and local culture about Michigan Tech and the surrounding area. We started the project because we noticed a lack of perservation for these terms we would hear around campus. We hope that through this site, we can help remedy that. This project was developed by 6 people for the Team Software Project class at Michigan Tech University during the Fall 2024 semester. </p>
                
                <h2>Who We Are</h2>
                <div class="person-box-container"> <!-- Contains boxes with people's names, roles, and contact info -L-->

                    <div class="person-box"> <!-- Please fill out a person-box for yourself whenever you get the time -L-->
                        <img src="./person_images/atlien.png" alt="Picture of Dmitri, Anders' cat" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Anders Lien</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>atlien@mtu.edu</p>
                        </div>
                    </div>
                    <div class="person-box"> 
                        <img src="./person_images/acontrer.jpg" alt="Picture of Benji, Arnold's cat" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Arnold Contreras</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>acontrer@mtu.edu</p>
                        </div>
                    </div>
                    <div class="person-box"> 
                        <img src="./person_images/ealfaro.jpg" alt="Picture of Eddie Alfaro" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Eddie Alfaro</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>ealfaro@mtu.edu</p>
                        </div>
                    </div>
                    <div class="person-box"> 
                        <img src="./person_images/haengelCat.png" alt="Picture of Cheddar, Hailey's cat" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Hailey Engel</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>haengel@mtu.edu</p>
                        </div>
                    </div>
                    <div class="person-box"> 
                        <img src="./person_images/ltshahid.jpg" alt="Picture of Liam Shahid" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Liam Shahid</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>ltshahid@mtu.edu</p>
                        </div>
                    </div>
                    <div class="person-box"> 
                        <img src="./person_images/zxlongCat.png" alt="Picture of Silver, Zane's cat" class="person-img">
                        <div class="person-text">
                            <p><b>Name: </b>Zane Long</p>
                            <p><b>Role: </b>Developer</p>
                            <p><b>Major: </b>Computer Science</p>
                            <p><b>Contact: </b>zxlong@mtu.edu</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer>
            <p style="color:black">You lost the game. :|</p>
        </footer>
        
    </body>


</html>