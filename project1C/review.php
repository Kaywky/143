<!DOCTYPE HTML>
<html>
<head>
<style>
    a:link {
    color: grey;
    background-color: transparent;
    text-decoration: none;
    }
    a:visited {
    color: grey;
    background-color: transparent;
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
    select, textarea, input[type=text] {
    width: 80%;
    }
    textarea {
    height: 150px;
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

    $query="SELECT id, title FROM Movie";
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs = $db->query($query);
    $row = $rs->fetch_array(MYSQL_NUM);
?>
    <form method="GET" action=review.php>
    <h2>Select a Movie:<br></h2>
    <SELECT NAME="movieid">
    <?php
    while($row = $rs->fetch_array(MYSQL_NUM))
        echo '<OPTION value='.$row[0].'>'.$row[1];
    ?>
    </SELECT>
    <input type="submit" name="search" value="search">
    </form>
    <br>
<?php

if($_GET['movieid']!=NULL){
    //show existed movie review
    $movieid=$_GET['movieid'];
    $query1="SELECT name, time, rating, comment FROM Review WHERE mid=$movieid";
    if (!($rs = $db->query($query1))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $query2="SELECT title FROM Movie WHERE id=$movieid";
    if (!($rs = $db->query($query2))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    $rs1 = $db->query($query1);
    $rs2 = $db->query($query2);
    $colums = $rs1->field_count;
    $rows = $rs1->num_rows;
    $row2= $rs2->fetch_array(MYSQL_NUM);
    $moviename=$row2[0];
    $rs2->free();
    echo '<br>Reviews and Ratings of <'. '<a href="show-movie-info.php?idnumber='.$movieid.'">'.$moviename . '<a>>:<br>';
    echo '<br><table>';
    echo '<tr>';
    while($colname = $rs1->fetch_field()){
        echo '<th>'.$colname->name.'</th>';
    }
    echo '</tr>';
    while($row = $rs1->fetch_array(MYSQL_NUM)){
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
    $rs1->free();
    ?>

    <form method="GET">
    <h3><br><br>Add your review:<br></h3>
    Movie title<br><SELECT name="movieid">
    <?php echo '<option value='.$movieid.'>'.$moviename;
    ?>
    </SELECT>
    <br><br>Your name<br><input type="text" name="name" value="anonymous"><br>
    <br>Your rating<br><SELECT name="rating">
    <option value=1>1
    <option value=2>2
    <option value=3>3
    <option value=4>4
    <option value=5>5
    </SELECT>
    <br><br>Your comment<br>
    <textarea name="comment"></textarea><br>
    <br><input type="submit" name="submit" value="submit"><br>
    </form>
<?php
}
if($_GET['rating']!=NULL && $_GET['submit']=="submit"){
    $name=$_GET['name'];
    $time= date("YmdHis");
    $mid=(int)$_GET['movieid'];
    $rating=(int)$_GET['rating'];
    $comment=$_GET['comment'];
    $query3="INSERT INTO Review VALUES('$name', $time, $mid, $rating, '$comment')";
    if (!($rs3 = $db->query($query3))) {
        $errmsg = $db->error;
        print "Query failed: $errmsg <br />";
        exit(1);
    }
    echo '<br>Your review has been added.<br>';
    $rs3->free();
}


$db->close();

?>

</article>
</body>

</html>