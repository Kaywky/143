<!DOCTYPE HTML>
<html>
<head>
<style>
    a:link {
    color: grey;
    text-decoration: none;
}
    a:visited {
    color: grey;
    text-decoration: none;
}
    h1 {
    padding: 1em;
    color: grey;
    background-color: gainsboro;
    clear: left;
    text-align: center;
}
    nav {
    background-color: gainsboro;
    float: left;
    max-width: 220px;
    padding: 2em;
}
    nav ul {
    list-style-type: none;
    padding: 0;
}
   nav ul a {
    text-decoration: none;
}
    article {
    margin-left: 300px;
    padding: 2em;
    color: grey;
    overflow: hidden;
    text-align: left;
}
    table {
    border-collapse: collapse;
    width: 80%;
    }
    th, td {
    padding:5px;
    border-bottom: 1px solid #ddd;
    }
    tr:hover {
    background-color: #f5f5f5;
    }    
    input[type=text] {
    width: 80%;
    }


</style>
</head>

<body>
<h1 style="font-family: verdana;"><b><a href="index.php">Project 1C: Movie Database</a></b></h1>
<nav>
    <p style="font-size:120%;">Add</p>
    <ul>
        <li><a href="add-actor-director.php">Add Actor/Director<a></li>
        <li><a href="add-movie-info.php">Add Movie Information<a></li>
        <li><a href="add-relation.php">Add Relation<a></li>
    </ul>
    <p style="font-size:120%;">Show</p>
    <ul>
        <li><a href="show-actor-info.php">Show Actor Information<a></li>
        <li><a href="show-director-info.php">Show Director Information<a></li>
        <li><a href="show-movie-info.php">Show Movie Information<a></li>
    </ul>
    <p style="font-size:120%;">Search</p>
    <ul>
        <li><a href="search.php">Search Actor/Director/Movie<a></li>
        <li><a href="review.php">Search Reivews and Ratings<a></li>
    </ul>
</nav>
<article>
    <h2>Add a New Movie</h2>
    <form method="GET" action="add-movie-info.php">
        <br><strong>Title</strong><br>
        <input type="text" name="title"><br>
        <br><strong>Year</strong><br>
        <input type="text" name="year"><br>
        <br><strong>Company</strong><br>
        <input type="text" name="company"><br>
        <br><strong>Rating</strong><br>
        <SELECT name="rating">
        <OPTION>G
        <OPTION>PG
        <OPTION>PG-13
        <OPTION>R
        <OPTION>NC-17
        <OPTION SELECTED>surrendere
        </SELECT><br>
        <br><strong>Genre</strong><br>
        <input type="checkbox" name="genre[]" id="genre" value="Drama">Drama
        <input type="checkbox" name="genre[]" id="genre" value="Comedy">Comedy
        <input type="checkbox" name="genre[]" id="genre" value="Romance">Romance
        <input type="checkbox" name="genre[]" id="genre" value="Crime">Crime
        <input type="checkbox" name="genre[]" id="genre" value="Horror">Horror
        <input type="checkbox" name="genre[]" id="genre" value="Mystery">Mystery
        <input type="checkbox" name="genre[]" id="genre" value="Thriller">Thriller
        <input type="checkbox" name="genre[]" id="genre" value="Action">Action
        <input type="checkbox" name="genre[]" id="genre" value="Adventure">Adventure
        <input type="checkbox" name="genre[]" id="genre" value="Fantasy">Fantasy
        <input type="checkbox" name="genre[]" id="genre" value="Documentary">Documentary
        <input type="checkbox" name="genre[]" id="genre" value="Family">Family
        <input type="checkbox" name="genre[]" id="genre" value="Sci-Fi">Sci-Fi
        <input type="checkbox" name="genre[]" id="genre" value="Animation">Animation
        <input type="checkbox" name="genre[]" id="genre" value="Musical">Musical
        <input type="checkbox" name="genre[]" id="genre" value="War">War
        <input type="checkbox" name="genre[]" id="genre" value="Western">Western
        <input type="checkbox" name="genre[]" id="genre" value="Adult">Adult
        <input type="checkbox" name="genre[]" id="genre" value="Short">Short       
        <br><br>
        <input type="submit" name="finish" value="submit"><br>
    </form>

<?php

if( $_GET["finish"]=="submit" && $_GET["title"]!=null && $_GET["year"]!=null && $_GET["company"]!=null )
{ 
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->maxdb_connect_errno > 0 ){
        die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
    }
    //generate query, add information to database
    $query1="SELECT id from MaxMovieID";
    if (!($rs = $db->query($query1))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs1=$db->query($query1);
    $row1=$rs1->fetch_array(MYSQL_NUM);
    $maxid=$row1[0];
    $id=$maxid+1;
    $rs1->free();
    $title=$_GET["title"];
    $year=$_GET["year"];
    $rating=$_GET["rating"];
    $company=$_GET["company"];

    $query2 = "INSERT INTO Movie VALUES($id, '$title', $year, '$rating', '$company')";
    if (!($rs = $db->query($query2))) {
        $errmsg = $db->error;
        print "<br>Query failed: $errmsg <br />";
        exit(1);
    }
    $query3="UPDATE MaxMovieID SET id=$id";
    if (!($rs = $db->query($query3))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $genre = $_GET['genre'];
    for($i=0; $i<count($genre); $i++){
        if($genre[$i]!=null){
            $type = $genre[$i];
            $query4 = "INSERT INTO MovieGenre VALUES($id, '$type')";
            $db->query($query4);            
        }
    }

    $db->close();
    echo "<br>Add succeeded :) You can go to search page to check.";
}


elseif ($_GET["finish"]==null) {}
else{
    echo "<br>Add failed :(<br>";
}

?>


</article>
</body>

</html>