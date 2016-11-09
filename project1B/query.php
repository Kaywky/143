<!DOCTYPE HTML>
<html>
  <h1><b>Movie Information</b></h1>
  <body>

<p> Type an SQL query in the following box: </p>
<p> Example: SELECT * FROM Actor WHERE id=10 </p>

  <form method = "GET" action="query.php">
  	<textarea name="query" rows=10 cols=60>
  	</textarea><br>
  	<input type="submit" value="submit">
  </form>

 <?php
 $db = new mysqli('localhost', 'cs143', '', 'CS143');

 if($db->maxdb_connect_errno > 0 ){
 	die('Unable to connect to database [' . $db->maxdb_connect_error . ']');
 }

 if($_SERVER["REQUEST_METHOD"]=="GET"){
 	$query = $_GET["query"];

 	$rs = $db->query($query);
 	if(!($rs = $db->query($query))){
 		$errmsg = $db->error;
 		echo "Query failed:" . $errmsg;
 		exit(1);
 	}else{
 		echo "<br>Result of ".$_GET["query"].":<br><br>";
 		$colums = $rs->field_count;
 		$rows = $rs->num_rows;
 		echo '<table border="1" width=50%>';
 		echo '<tr>';
 		while($colname = $rs->fetch_field()){
 			  echo '<th>'.$colname->name.'</th>';
 		}
 	    echo '</tr>';
 		while($row = $rs->fetch_array(MYSQL_NUM)){
 			echo '<tr>';
 			for($x = 0; $x < count($row); $x++){
 				if($row[$x]==NULL)
 					echo '<th>N/A</th>';
 				else
 					echo '<th>'.$row[$x].'</th>';
 			}
 			echo '</tr>';
 	 	}
 	 	echo '</table>';
 	 	print '<br>Total results:' . $rs->num_rows;
 	 	$rs->free();
 	 }
 	}
 $db->close();

 ?>


  </body>
</html>