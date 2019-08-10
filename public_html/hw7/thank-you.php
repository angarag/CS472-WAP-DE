<?php include "../hw4/top.html";
session_start();
?>
<div>
    <h1>Thank you!</h1>
<p>Welcome to <?=$_SESSION["username"]?></p>
<p>Now <a href="view-match.php">continue on to see your matches</a></p>

</div>

<?php include "../hw4/bottom.html";?>
