<!DOCTYPE html>
<html>
  <head>
    <title>turnin backend</title>
    <meta charset="utf-8" />
    <link href="./viewer.css" type="text/css" rel="stylesheet" />
  </head>

  <body>
    <form action="turnin.php" method="POST" enctype="multipart/form-data">
      <label for="mars">
        <input type="text" name="mars" value="" placeholder="Enter your name" />
      </label>
      <input type="submit" value="Submit" />
      <label for="mars_file">
      Upload file</label>
      <input type="file" name="mars_file"/>
    </form>
    <?php
    session_start();
    if(isset($_SESSION["W6-exercise"])){
    echo $_SESSION["W6-exercise"];
    session_destroy();

    }
    ?>
  </body>
</html>
