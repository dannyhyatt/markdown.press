<!DOCTYPE html>
<html>
<head>
  <title>Create a Snippet | Markdown.press</title>
  <link rel='stylesheet' href='/universal.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
      var markdown = "";
      function change() {
          var converter = new showdown.Converter();
          markdown = document.getElementsByTagName('textarea')[0].value;
          var html = converter.makeHtml(markdown);
          var output = document.getElementById('output-div');
          var input = document.getElementById('input-div');
          if(output.className == 'invisible') {
              output.className = "";
              input.className = "invisible";
              document.getElementById('switch-btn').innerText = 'Input';
              output.innerHTML = html;
          } else {
              output.className = "invisible";
              document.getElementById('switch-btn').innerText = 'Output';
              input.className = "";
          }
      }
  </script>
  <script src="https://cdn.rawgit.com/showdownjs/showdown/1.9.0/dist/showdown.min.js"></script>
</head>
<?php

	if(isset($_POST['content'])) {

		$content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
		$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
		$author = htmlspecialchars($_POST['author'], ENT_QUOTES, 'UTF-8');
		// don't forget to change
	  	$mysqli = new mysqli("host", "username", "password", "database");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		$pass = randStr();

		if(!$mysqli->query("INSERT into `contents` (
	        title, content, author, edit_password
		    ) VALUES (
		        '" . $title . "', '" . $content . "', '" . $author . "', '" .$pass . "'
		    );")) {
		    echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;

		} else {
			$res = $mysqli->query('SELECT id FROM `contents` WHERE edit_password="' . $pass . '";'); // this might need to be fixed

			if($mysqli->errno) {
				// error todo
				die("Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}

			$res->data_seek(0);
			$row = $res->fetch_assoc();

			$link = '/edit/?snippet=' . $row['id'] . '&pass=' . $pass;

			echo '<body style="padding-top: 15vh;"><h1>Success!</h1><h2><h2>Click <a href="/view/?snippet_id=' . $row['id'] . '">here</a> to view your snippet.</h2><h2>Keep this link to edit your snippet:</h2><h3><a href="' . $link . '">https://markdown.press' . $link . '</a></h3>';
			die('</body></html>');
		}
	}

	function randStr($length = 8) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

?>
<body>
	<h1>This is Markdown.press</h1>
	<h2>Create a Snippet</h2>
	<!-- todo put markdown article for why markdown ? -->
	<form action="/create/" method="POST">
		<h3>Title</h3>
		<input type="text" name="title" title="Snippet Title">
		<h3>Author</h3>
		<input type="text" name="author" title="Snippet Title">
    	<h3 style="floatRight">Content<!--<a href="/" style="float:right;margin-left:0.5em;">Big</a>--><a href="javascript:change();" id="switch-btn" style="float:right;">Output</a></h3>
		<div id='input-div'>
    		<textarea name="content" title="Snippet Content" class="big"></textarea>
		</div>
		<div id='output-div' class="invisible"></div>
		<h3><a href="javascript:document.forms[0].submit();">Submit</a></h3>
	</form>
	<footer>
		<p>Created by <a href="https://dannyhyatt.com">Daniel Hyatt</a>, with inspiration from <a href="http://txti.es">txti.es</a> and <a href="https://bestmotherfucking.website">Best Mother F*cking Website</a>.</p>
	</footer>
</body>
</html>
