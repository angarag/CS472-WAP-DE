<html>
  <head>
    <title>Lab 5</title>
    <link href="./lab5.css" type="text/css" rel="stylesheet" />
  </head>
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
    <div>
      <h2>Exercise : Multi-table query 1: Pi</h2>
      <p>
        Show all roles played in the movie named Pi. To achieve this, join the
        movies table with the roles table and filter out all records except
        those in Pi. You shouldn't need to know the movie ID of Pi ahead of time
        to do the query.
      </p>
      <code
        >SELECT role FROM `roles` where movie_id= (SELECT id FROM `movies` where
        name="Pi")</code
      >
    </div>
    <div>
      <h2>Exercise : Multi-table query 2: Pi Actor Names</h2>
      <p>
        Show the first/last names of all actors who appeared in Pi, along with
        their roles. You will need to join all three tables.
      </p>
      <code
        >SELECT first_name,last_name,role FROM `roles` join actors on
        roles.actor_id=actors.id where movie_id= (SELECT id FROM `movies` where
        name="Pi")</code
      >
    </div>
    <div>
      <h2>Exercise : Multi-table query 3: Kill Bill</h2>
      <p>
        Show the first/last names of all actors who appeared in both Kill Bill:
        Vol. 1 and Kill Bill: Vol. 2. Join five tables: an actors, two movies,
        and two roles. Use JOIN ON to link the actor to both roles, and to link
        each role to one of the movies. Use WHERE to grab only the two Kill Bill
        movies. (Our answer has 4 JOIN ONs and 2 WHERE parts.)
      </p>
      <code>
        SELECT first_name,last_name FROM `actors` where id in ( select actor_id
        from (select actor_id from roles where movie_id in ( SELECT id FROM
        `movies` where name = "Kill Bill: Vol. 1")) as mars where actor_id in
        (select actor_id from roles where movie_id = (SELECT id FROM `movies`
        where name = "Kill Bill: Vol. 2")) )
      </code>
    </div>
    <div>
      <?php
                  echo 'connect to the imdb_small database';

      $db = new PDO("mysql:dbname=imdb_small", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); echo 'query
      the database to see the movie names'; $rows = $db->prepare("SELECT name
      FROM movies WHERE year = 2000"); $rows->execute(); foreach ($rows as $row)
      { ?>

      <p><?= $row["name"] ?></p>

      <?php
            			}
            			?>
    </div>
  </body>
</html>
