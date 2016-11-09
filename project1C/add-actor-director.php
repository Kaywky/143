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
    <h2>Add a New Actor/Director</h2>
    <form method="GET" action="add-actor-director.php">
        <input type="radio" name="addwho" value=1 checked>
        actor<br>
        <input type="radio" name="addwho" value=2>
        director<br>
        <br><strong>last name</strong><br>
        <input type="text" name="lastname"><br>
        <br><strong>first name</strong><br>
        <input type="text" name="firstname"><br>
        <br><strong>sex</strong><br>
        <input type="radio" name="sex" value=1 checked>
        Male<br>
        <input type="radio" name="sex" value=2>
        Female<br>
        <br><strong>date of birth</strong><br>
        <input type="text" name="dob"><br>example: 19930518<br>
        <br><strong>date of death</strong><br>
        <input type="text" name="dod"><br>
        leave it blank if still alive<br>
        <br>
        <input type="submit" name="finish" value="submit"><br>
    </form>

<?php

if( $_GET["finish"]=="submit" && $_GET["lastname"]!=null && $_GET["firstname"]!=null && $_GET["dob"]!=null )
{ 
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if($db->maxdb_connect_errno > 0 ){
        die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
    }
    //generate query, add information to database
    $query1="SELECT id from MaxPersonID";
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
    $last=$_GET["lastname"];
    $first=$_GET["firstname"];
    if($_GET["sex"]==1)
        $sex="Male";
    elseif($_GET["sex"]==2)
        $sex="Female";
    $dob=$_GET["dob"];
    $dobmonth=substr($dob,4,2);
    $dobyear=substr($dob,0,4);
    $dobday=substr($dob,6);
    if(!checkdate($dobmonth, $dobday, $dobyear)){
        echo "<br>Wrong time input :(<br>";
        exit();
    }
    $dod=$_GET["dod"];
    $dodmonth=substr($dod,4,2);
    $dodyear=substr($dod,0,4);
    $dodday=substr($dod,6);  
    if($_GET["addwho"]==1){
        if($dod==null)
            $query2 = "INSERT INTO Actor VALUES($id, '$last', '$first', '$sex', $dob, NULL)";
        else{
            if(!checkdate($dodmonth, $dodday, $dodyear)){
                echo "<br>Wrong time input :( <br>";
                exit();
            }
            $query2 = "INSERT INTO Actor VALUES($id, '$last', '$first', '$sex', $dob, $dod)";
        }
    if (!($rs = $db->query($query2))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    }

    if($_GET["addwho"]==2){
        if($dod==null)
            $query2 = "INSERT INTO Director VALUES($id, '$last', '$first', $dob, NULL)";
        else{
            if(!checkdate($dodmonth, $dodday, $dodyear)){
                echo "<br>Wrong time input :( <br>";
                exit();
            }
            $query2 = "INSERT INTO Director VALUES($id, '$last', '$first', $dob, $dod)";
        }
    if (!($rs = $db->query($query2))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    }

    $query3="UPDATE MaxPersonID SET id=$id";
    if (!($rs = $db->query($query3))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }

    $db->close();
    echo "<br>Add succeeded :) You can go to search page to check.";

}

elseif ($_GET["addwho"]==null) {}
else{
    echo "<br>Add failed :(<br>";
}

?>


</article>
</body>

</html>