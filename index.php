<?php
if (!isset($_POST["submit"])) {
  ?>
  <html>
  <head>
  <title>DGM Mailing List Signup</title>
  </head>
  <body>
  <br>
  <center>
  <img src="3by2.png"><br>
  <br><br>
  <h1 style="font-size: 3.3em;">Email List Signup</h1>
  <br><br>
  <form method="post" action="http://localhost">
  Email address: <input type="text" size="30" name="email"><br />
  <br><br>
  Comments (optional):<br>
  <textarea rows="6" cols="60" name="comments" wrap="virtual">
  </textarea><br />
  <br>

  <input type="submit" value="submit" name="submit"><br />
  </form>
  </center>
  </body>
  </html>
  <?php
} else {
  $email=$_POST["email"];
  $comments=$_POST["comments"];

  $link = mysql_connect('localhost','dgm','dgm') or die(mysql_error()); 
  mysql_select_db("dgm", $link) or die(mysql_error());

  $ihatephp = sprintf("INSERT INTO data (email, comments) VALUES (\"%s\", \"%s\")", mysql_real_escape_string($email), mysql_real_escape_string($comments));

  mysql_query($ihatephp, $link) or die(mysql_error());

  mysql_close($link) or die(mysql_error());

  ?>
  <html>
  <head>
  <title>DGM Mailing List Signup</title>
  <meta http-equiv="refresh" content="4;url=/" />
  </head>
  <body><br><br>
  <center>
  <h2>Thanks for subscribing!</h2>
  </center>
  </body>
  </html>
  <?php
  }
?>
