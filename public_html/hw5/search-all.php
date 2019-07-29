<?php
$name=$_POST["firstname"];
$dsn = 'mysql:dbname=imdb_small;port=3306;host=127.0.0.1';
$user = 'movies';
$password = 'popcorn';

try {
    $dbh = new PDO($dsn, $user, $password);

    $stmt = $dbh->prepare("select * from (SELECT movie_id FROM `roles` where actor_id = (SELECT id FROM `actors` where first_name=:fname and last_name=:lname)) as mars join movies on mars.movie_id=movies.id");
$stmt->bindParam(':fname', $_POST["firstname"]);
$stmt->bindParam(":lname",$_POST["lastname"]);
$stmt->execute();
$rows=$stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage(); } 
    
    ?>
<!DOCTYPE html>
<html>
  <!-- CSE 190 M Homework 5 (Kevin Bacon) -->
  <head>
    <title>My Movie Database (MyMDb)</title>
    <meta charset="utf-8" />

    <!-- Links to provided files.  Do not edit or remove these links -->
    <link
      href="http://www.cs.washington.edu/education/courses/cse190m/12su/homework/5/images/favicon.png"
      type="image/png"
      rel="shortcut icon"
    />
    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"
      type="text/javascript"
    ></script>
    <script
      src="http://www.cs.washington.edu/education/courses/cse190m/12su/homework/5/provided.js"
      type="text/javascript"
    ></script>

    <!-- Link to your CSS file that you should edit -->
    <link href="./images/bacon.css" type="text/css" rel="stylesheet" />
  </head>

  <body>
    <div id="frame">
      <header>
        <a href="index.php"
          ><img
            src="http://www.cs.washington.edu/education/courses/cse190m/12su/homework/5/images/mymdb.png"
            alt="banner logo"
        /></a>
        <span>
          My Movie Database
        </span>
      </header>

      <div id="main">
        <h1>
          Results for
          <?=$name?>
        </h1>
        <p>Films</p>
        <table>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Year</th>
          </tr>

          <?php
          $index=1;
          foreach($rows as $row){
              ?>
              <tr>
                  <td><?=$index++?></td>
                  <td><?=$row["name"]?></td>
                  <td><?=$row["year"]?></td>
              </tr>
              <?php
          }
          ?>
        </table>

        <?php include("./common.php")?>
      </div>

      <footer>
        <a href="https://webster.cs.washington.edu/validate-html.php"
          ><img
            src="https://webster.cs.washington.edu/w3c-html.png"
            alt="Valid HTML5"
        /></a>
        <a href="https://webster.cs.washington.edu/validate-css.php"
          ><img
            src="https://webster.cs.washington.edu/w3c-css.png"
            alt="Valid CSS"
        /></a>
      </footer>
    </div>
  </body>
</html>
