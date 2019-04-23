<!DOCTYPE html>
<html>
<head>
  <title>Markdown.press</title>
  <link rel='stylesheet' href='/universal.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class='top-padding'>
	<h1>This is<br>Markdown.press</h1>
	<h2>Home to 
	  <?php
		// don't forget to change
	  	$mysqli = new mysqli("host", "username", "password", "database");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}


		$res = $mysqli->query("select count(*) from contents;");
		$res->data_seek(0);
		echo $res->fetch_assoc()['count(*)'];

	  ?> markdown snippets.
	</h2>
	<!-- todo put markdown article for why markdown ? -->
	<p><a href="/create">Create your first snippet</a> or read: <a href="https://markdown.press/view/?snippet_id=1">why markdown?</a></p>
	<footer>
		<p>Created by <a href="https://dannyhyatt.com">Daniel Hyatt</a>, with inspiration from <a href="http://txti.es">txti.es</a> and <a href="https://bestmotherfucking.website">Best Mother F*cking Website</a>.</p>
	</footer>
</body>
</html>
