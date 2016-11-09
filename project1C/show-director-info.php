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
  <h2>Director Searching:</h2>
  <form method="GET" action="search.php">
    <input type="text" name="searchcontent" size=100>
    <input type="submit" name="ifdirector" value="search">
  </form>


<?php
 $db = new mysqli('localhost', 'cs143', '', 'CS143');

 if($db->maxdb_connect_errno > 0 ){
    die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
 }


$idnumber=$_GET['idnumber'];
 if($idnumber!=NULL){

    //display one certain actor's personal information
    $query="SELECT last, first, dob, dod FROM Director WHERE id=$idnumber";
    if (!($rs = $db->query($query))){
    $errmsg = $db->error;
    print "Query failed: $errmsg <br />";
    exit(1);
}
    $rs = $db->query($query);
    $colums = $rs->field_count;
    $rows = $rs->num_rows;
    print '<br>Director Information: ' . $rs->num_rows;
    echo '<br><table>';
    echo '<tr>';
    while($colname = $rs->fetch_field()){
        echo '<th>'.$colname->name.'</th>';
    }
    echo '</tr>';
    while($row = $rs->fetch_array(MYSQL_NUM)){
        echo '<tr>';
        for($x = 0; $x < count($row); $x++){
            if($row[$x]==NULL)
                echo '<td>N/A</td>';
            else
                echo '<td>' . $row[$x] . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    $rs->free();

    //display this director's movies
    $query="SELECT id, title, year FROM MovieDirector, Movie WHERE did=$idnumber AND mid=id";
    if (!($rs = $db->query($query))){
    $errmsg = $db->error;
    print "Query failed: $errmsg <br />";
    exit(1);
}
    $rs = $db->query($query);
    $colums = $rs->field_count;
    $rows = $rs->num_rows;
    print '<br>Movie Information: ' . $rs->num_rows;
    echo '<br><table>';
    echo '<tr>';
    while($colname = $rs->fetch_field()){
        echo '<th>'.$colname->name.'</th>';
    }
    echo '</tr>';
    while($row = $rs->fetch_array(MYSQL_NUM)){
        echo '<tr>';
        for($x = 0; $x < count($row); $x++){
            if($row[$x]==NULL)
                echo '<td><a href="show-movie-info.php?idnumber='.$row[0].'"'.'>N/A<a></td>';
            else
                echo '<td><a href="show-movie-info.php?idnumber='.$row[0].'">'. $row[$x] . '<a></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    $rs->free();

    }

 

 $db->close();

 ?>



</article>
</body>

</html>