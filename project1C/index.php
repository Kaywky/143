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
    background-color: gainsboro;
    overflow: hidden;
    text-align: center;
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
	<h1 >Welcome to Kaiyi's Movie Database!</h1>
	<p>Personal Information:<br>Name: Kaiyi Wu<br>UID: 004761345<br>Email: kaiyiwu@ucla.edu</p>
</article>
</body>

</html>