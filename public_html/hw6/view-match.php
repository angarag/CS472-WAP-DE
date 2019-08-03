<?php include "../hw4/top.html";
session_start();
$username=$_SESSION["username"];
if(!$username){
header("Location: login.php?message=loginFirst");
}
else
?>
<h1><?="Matches for " . $_SESSION["username"]?></h1>
<a href="logout.php">Log out</a>
<?php
$matches= $_SESSION["matches"];
$index=isset($_GET["match"])?$_GET["match"]:0;
$match=$matches[$index];
if($match) {
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
<div>
<?php if($index>0){?>
<a href="./view-match.php?match=<?=$index-1?>">Previos Match</a>
<?php }
if($index<count($matches)-1){?>
<a href="./view-match.php?match=<?=$index+1?>">Next Match</a>
<?php }?>
</div>
<?php include "../hw4/bottom.html";?>
