<?php include "../hw4/top.html";
include("../hw5/db-connection.php");
?>

<h1><?="Matches for " . $_POST["name"]?></h1>
<?php
$matches= getMatches();
foreach ($matches as $match) {
    ?>
<div class="match">
  <img src="../hw4/images/user.jpg" alt="" />
  <p><?=$match["name"]?></p>
  <ul>
    <li>
      <span class="label.left"><strong>gender:</strong><?=$match["gender"]?></span>
    </li>
    <li>
      <span class="label.left"><strong>age:</strong><?=$match["age"]?></span>
    </li>
    <li>
      <span class="label.left"><strong>type:</strong><?=$match["type1"].$match["type2"].$match["type3"].$match["type4"]?></span>
    </li>
    <li>
      <span class="label.left"><strong>OS:</strong><?=$match["os"]?></span>
    </li>
  </ul>
</div>

    <?php
}
?>
<?php include "../hw4/bottom.html";?>
