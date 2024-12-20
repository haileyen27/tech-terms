<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Categories - Organizational - Tech Terms</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        
    </head>
    <body>
        <header>
            <h1 id="title">Tech Terms</h1>
            <div id="navbar">
                <button type="button" class="navbutton"><a href="../index.html">Home</a></button> <!-- change buttons to onclick when JS/php is integrated -H-->
                <button type="button" class="navbutton"><a href="../pagelist.html">All Pages</a></button>
                <select type ="button" class="navbutton" name="categories" placeholder="Categories" onchange="
                    if(this.value == 3) {
                        window.location.href = './events.html';
                    } else if (this.value == 2){
                        window.location.href = './locations.html';
                    } else if (this.value == 1){
                        window.location.href = './terms.html';
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
                        var arrayOfSites = ["../articles/EatsHit.html", "../articles/WalkerPool.html"];
                        var randomSite = arrayOfSites[Math.floor(Math.random() * arrayOfSites.length)];
                        window.location.replace(randomSite);
                    }
                </script>
                <div class="navbutton" style="padding:0px;border-width:0px;">
                    <input type="text" class="navbutton" id="searchbar" name="searchbar" placeholder="Search..."><input type="submit" class="navbutton" value="&rArr;">
                    <!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
                </div>
                <button type="button" class="navbutton" id="login">Log In</button>
            </div>
        </header>
        
        <main>
            <div class="spacer"></div> <!-- spacer used to prevent main body from overlapping with header -H -->
            <div class="tags">
                Tags: <a href="./categories.html">Categories</a>
            </div>
            <div class="article-title">
                <h1>Organizational (Category)</h1>
            </div>
            <div class="article-content"> <!-- div used to realign flexboxes at smaller sizes -H -->
                <div class="content-body">
                    <h2>About This Category</h2>
                        <p>This category contains organizational pages</p>
                    <h2>List of Pages in Category</h2>
                        <li><a href="../pagelist.html">List of All Pages</a></li>
                </div>
            </div>
        </main>

        <footer>
            <p>Copyright [team] 2024</p>
        </footer>
        
    </body>
</html>