<?php 
	
	require('../Parsedown.php');

	$snippet_id = $_GET['snippet_id'];
	$content = "";
	$author = "";
	$title = "";
	$date = ""; //todo

	// don't forget to change
	$mysqli = new mysqli("host", "username", "password", "database");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$query = 'SELECT * FROM `contents` WHERE id=' . $snippet_id . ';';

	$res = $mysqli->query($query);
	if(!$res) {
    	die("Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
	}
	$res->data_seek(0);
    $row = $res->fetch_assoc();
	$content = $row['content'];
	$author = $row['author'];
	$title = $row['title'];
	$Parsedown = new Parsedown();
	$content = $Parsedown->text($content);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
  	<link rel='stylesheet' href='/universal.css'>
  	<style>
  		p {
  			font-size: 1.35em;
  		}
  	</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<h1><?php echo $title; ?></h1>
	<h2><?php if($author != '') echo 'by ' . $author; ?></h2>
	<p><?php echo $content; ?></p>
	
	<p>The above snippet was created with <a href="/">markdown.press</a>.</p>
</body>
</html>
