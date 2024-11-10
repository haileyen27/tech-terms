

<!DOCTYPE html>
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
                <button type="button" class="navbutton"><a href="./index.html">Home</a></button> <!-- change buttons to onclick when JS/php is integrated -H-->
                <button type="button" class="navbutton"><a href="./pagelist.html">All Pages</a></button>
                
                <select type="button" class="navbutton" name="categories" placeholder="Categories">
                    <option>Categories</option><!--go to list of categories -H-->
                    <option>Terms</option>
                    <option>Locations</option>
                    <option>Events</option>
                </select> <!-- Need to go to page on click (form submit + script go to link on option select) -H-->
                
                <button type="button" class="navbutton">Random</button>

                <div class="navbutton" style="padding:0px;border-width:0px;">
                <form method="post" action="index.php">
                    <input type="text" class="navbutton" id="searchbar" name="searchterm" placeholder="Search..."><input type="submit" name="sendsearch" class="navbutton" value="&rArr;">
                    <!--Searchbar and submit button must remain on same line or it adds a gap. Button will be connected to PHP for search functionality. -H-->
                </form>
                </div>

                <button type="button" class="navbutton" id="login">Log In</button>

                <?php

                    require "EditorLogin/db.php";
                    session_start();
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
            <h2>Search results containing "<?php echo $_SESSION["searchterm"];?>":</h2>
            <div class="article-content"> <!-- div used to realign flexboxes at smaller sizes -H -->
                <div class="content-body">
                    <?php
                        //TODO: uncomment once database connection is ready -H
                        /*$results = search($_POST["searchterm"]);
                        foreach($results as $res){ //$results columns: id (0), title (1), path (2)
                            echo "<li><a href=\"".$res[2]."\">".$res[1]."</a></li>";
                        }*/

                        //Test that echo statement works as intended. Leave commented as example. -H
                        /*$results[0][2] = "articles/articletemplate.html";
                        $results[0][1] = "Article Template";
                        $results[1][2] = "categories/categorytemplate.html";
                        $results[1][1] = "Category Template";
                        foreach($results as $res){
                            echo "<li><a href=\"".$res[2]."\">".$res[1]."</a></li>";
                        } */
                        
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>
