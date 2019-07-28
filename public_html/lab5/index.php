<html>
  <body>
    <div>
      <h2>Exercise : Single-table query 1: Julia</h2>
      <p>
        Show all columns of all actors who have the first name Julia. If you
        have the right query, you should see:
      </p>
      <code>
        SELECT * FROM `actors` where binary first_name="Julia"
      </code>
    </div>
    <div>
      <h2>Exercise : Single-table query 2: 1995-2000</h2>
      <p>
        Show just the IDs and names of all movies released between 1995-2000
        inclusive. You should see (trimmed):
      </p>
      <code>SELECT id,name FROM `movies` where year>1994 and year<2001</code>
    </div>
    <div>
      <h2>Exercise : Single-table query 3: Fight Club</h2>
      <p>
        Show the IDs of all actors who appeared in the movie Fight Club. Use the
        ID of Fight Club from the previous query.
      </p>
      <code
        >SELECT actor_id FROM `roles` where movie_id = (select id from movies
        where name="Fight Club")</code
      >
    </div>
    <div>
      <h2>Multi-table (JOIN) queries</h2>
      <p>
        The following SQL queries are more difficult because they involve
        joining results from multiple tables.
      </p>
      <code
        >SELECT actors.id, actors.first_name,actors.last_name,actors.gender,
        movies.id,movies.name,movies.year,roles.actor_id,roles.movie_id,roles.role
        FROM (`roles` join actors on roles.actor_id=actors.id) join movies on
        roles.movie_id=movies.id</code
      >
    </div>
    <ul>
      <?php
            			# connect to the imdb_small database
            			$db = new PDO("mysql:dbname=imdb_small", "root", "");
                        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      #query the database to see the movie names $rows = $db->prepare("SELECT
      name FROM movies WHERE year = 2000"); $rows->execute(); foreach ($rows as
      $row) { ?>

      <p><?= $row["name"] ?></p>

      <?php
            			}
            			?>
    </ul>
  </body>
</html>
