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
    select, input[type=text] {
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

<?php
 $db = new mysqli('localhost', 'cs143', '', 'CS143');
 if($db->maxdb_connect_errno > 0 ){
    die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
 }

    $query1="SELECT id, title FROM Movie";
    if (!($rs = $db->query($query1))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs1 = $db->query($query1);
    $row1 = $rs1->fetch_array(MYSQL_NUM);
    $query2="SELECT id, last, first FROM Actor";
    if (!($rs = $db->query($query2))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs2 = $db->query($query2);
    $row2 = $rs2->fetch_array(MYSQL_NUM);
    $query3="SELECT id, last, first FROM Director";
    if (!($rs = $db->query($query3))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs3 = $db->query($query3);
    $row3 = $rs3->fetch_array(MYSQL_NUM);
?>
    <h2>Add a New Relation</h2>
    <form method="GET" action="add-relation.php">
        <input type="radio" name="relation" value=1 checked>
        Movie-Actor<br>
        <input type="radio" name="relation" value=2>
        Movie-Director<br><br>
        <strong>Title<strong><br>
        <SELECT NAME="movieid">
    <?php
        while($row1 = $rs1->fetch_array(MYSQL_NUM))
        echo '<OPTION value='.$row1[0].'>'.$row1[1];
    ?>
        </SELECT><br>
        <br><strong>Actor</strong><br>
        <SELECT NAME="actorid">
    <?php
        while($row2 = $rs2->fetch_array(MYSQL_NUM))
        echo '<OPTION value='.$row2[0].'>'.$row2[1].' '.$row2[2];
    ?>
        </SELECT><br>
        <br><strong>Role</strong><br>
        <input type="text" name="role"><br>
        <br><strong>Director</strong><br>
        <SELECT NAME="directorid">
    <?php
        while($row3 = $rs3->fetch_array(MYSQL_NUM))
        echo '<OPTION value='.$row3[0].'>'.$row3[1].' '.$row3[2];
    ?>
        </SELECT><br><br>
        <input type="submit" name="finish" value="submit"><br>
    </form>

<?php    
    $mid=$_GET["movieid"];
    $aid=$_GET["actorid"];
    $did=$_GET["directorid"];
    $role=$_GET["role"];
    $rs1->free();
    $rs2->free();
    $rs3->free();

if( $_GET["finish"]=="submit" && $_GET["movieid"]!=null && $_GET["actorid"]!=null && $_GET["role"]!=null && $_GET["relation"]==1)
{ 
    $query = "INSERT INTO MovieActor VALUES($mid, $aid, '$role')";
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $db->close();
    echo "<br>Add succeeded :) You can go to search page to check.";
}

elseif( $_GET["finish"]=="submit" && $_GET["movieid"]!=null && $_GET["directorid"]!=null && $_GET["relation"]==2)
{
    

    $query = "INSERT INTO MovieDirector VALUES($mid, $did)";
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
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