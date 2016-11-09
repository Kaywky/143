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
  <h2>Searching Page:</h2>
  <form method = "GET" action="search.php" >
    <input type="text" name="searchcontent" size=100>
    <input type="submit" value="search"><br>
    <input type="checkbox" name="ifactor" value="search">search for actors<br>
    <input type="checkbox" name="ifdirector" value="search">search for directors<br>
    <input type="checkbox" name="ifmovie" value="search">search for movies
    <br><strong>Attention: <br></strong>
    For actor searching and director searching, you should enter UP TO 2 key words. <br>
    Example: Tom Hanks<br>
  </form>

<?php
 $db = new mysqli('localhost', 'cs143', '', 'CS143');

 if($db->maxdb_connect_errno > 0 ){
    die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
 }

if($_GET["searchcontent"] != NULL){
    $content = $_GET["searchcontent"];
    $content = trim($content);
    $content = preg_replace("/\s+/",' ', $content);
    $arr = array();
    $arr = explode(" ", $content);
    $len = count($arr);

    if($_GET["ifactor"]=="search"){
        if($len>2){
            echo "<br><h4>You entered more than two key words. Please re-search :(</h4> ";
        }
        elseif($len==2){
            $query = "SELECT * FROM Actor WHERE (first regexp '$arr[0]+' AND last regexp '$arr[1]+') OR (first regexp '$arr[1]+' AND last regexp '$arr[0]+')";
            if (!($rs = $db->query($query))){
                $errmsg = $db->error;
                print "Query failed: $errmsg <br />";
                exit(1);
            }
            $rs = $db->query($query);

            $colums = $rs->field_count;
            $rows = $rs->num_rows;
            print '<br>Total Matching Actors: ' . $rs->num_rows;
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
                        echo '<td><a href="show-actor-info.php?idnumber='.$row[0].'"'.'>N/A<a></td>';
                    else
                        echo '<td><a href="show-actor-info.php?idnumber='.$row[0].'"'.'>' . $row[$x] . '<a></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            $rs->free();
        }
        else{
            $query = "SELECT * FROM Actor WHERE first regexp '$arr[0]+' OR last regexp '$arr[0]+'";
            if (!($rs = $db->query($query))){
                $errmsg = $db->error;
                print "Query failed: $errmsg <br />";
                exit(1);
            }
            $rs = $db->query($query);

            $colums = $rs->field_count;
            $rows = $rs->num_rows;
            print '<br>Total Matching Actors: ' . $rs->num_rows;
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
                        echo '<td><a href="show-actor-info.php?idnumber='.$row[0].'"'.'>N/A<a></td>';
                    else
                        echo '<td><a href="show-actor-info.php?idnumber='.$row[0].'"'.'>' . $row[$x] . '<a></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            $rs->free();
        }

        }

    if($_GET["ifdirector"]=="search"){
        if($len>2){
            echo "<br><h4>You entered more than two key words. Please re-search :(</h4> ";
        }
        elseif($len==2){
            $query = "SELECT * FROM Director WHERE (first regexp '$arr[0]+' AND last regexp '$arr[1]+') OR (first regexp '$arr[1]+' AND last regexp '$arr[0]+')";
            if (!($rs = $db->query($query))) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br />";
                exit(1);
            }

            $rs = $db->query($query);

            $colums = $rs->field_count;
            $rows = $rs->num_rows;
            print '<br>Total Matching Directors: ' . $rs->num_rows;
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
                        echo '<td><a href="show-director-info.php?idnumber='.$row[0].'">N/A<a></td>';
                    else
                        echo '<td><a href="show-director-info.php?idnumber='.$row[0].'">' . $row[$x] . '<a></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            $rs->free();
        }
        else{
            $query = "SELECT * FROM Director WHERE first regexp '$arr[0]+' OR last regexp '$arr[0]+'";
            if (!($rs = $db->query($query))) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br />";
                exit(1);
            }
            $rs = $db->query($query);

            $colums = $rs->field_count;
            $rows = $rs->num_rows;
            print '<br>Total Matching Directors: ' . $rs->num_rows;
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
                        echo '<td><a href="show-director-info.php?idnumber='.$row[0].'">N/A<a></td>';
                    else
                        echo '<td><a href="show-director-info.php?idnumber='.$row[0].'">' . $row[$x] . '<a></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            $rs->free();  
        }
    }

        if($_GET["ifmovie"]=="search"){
            $query="SELECT * FROM Movie WHERE title regexp '$arr[0]+'";
            for($i=1; $i<$len; $i++){
            $query = $query . " AND title regexp '$arr[$i]+'";
            if (!($rs = $db->query($query))) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br />";
                exit(1);
            }
        }
            $rs = $db->query($query);

            $colums = $rs->field_count;
            $rows = $rs->num_rows;
            print '<br>Total Matching Movies: ' . $rs->num_rows;
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
                        echo '<td><a href="show-movie-info.php?idnumber='.$row[0].'">N/A<a></td>';
                    else
                        echo '<td><a href="show-movie-info.php?idnumber='.$row[0].'">' . $row[$x] . '<a></td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            $rs->free();
        }
        if ($_GET["ifactor"]!="search" && $_GET["ifdirector"]!="search" && $_GET["ifmovie"]!="search"){
            echo "<h4><br>Please select searching options :)</h4>";
        }

    }



 $db->close();

?>

</article>



</body>

</html>