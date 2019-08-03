<?php
function resetSession(){
  session_start();
  session_regenerate_id();
session_destroy();
header("Location: poweranimal.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_POST["reset"])){
    resetSession();
  }
  else {
  session_start();
  session_regenerate_id();
  $_SESSION["pic"]=$_POST["picture"];
  header("Location: poweranimal.php");
  }
}
else {
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="./lab6.css" />
    <title>Power Animal</title>
  </head>

  <body>
    <?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
resetSession();
}
else {
if(isset($_SESSION["count"])){
$_SESSION["count"]=$_SESSION["count"]+1;
}else {
$_SESSION["count"]=1;
}
$str=isset($_SESSION["pic"])?$_SESSION["pic"]:"";
if($str==""){
  $str="Please choose one of the following pictures";
}
else {
  $str="You have chosen ".$str." before";
}
?>
<p>Total view count: <?=$_SESSION["count"]?></p>
    <form action="poweranimal.php" method="post">
      <input type="submit" value="Reset" name="reset"/>
    </form>
    <p><?=$str?></p>
<?php
if(!isset($_SESSION["pic"])){
?>
<form action="poweranimal.php" method="post">
<?php
foreach(scandir("./../hw3") as $key=>$value){
   if($key>1 && strpos($value,".php")==false){ ?>
<button type="submit" value=<?=$value?> name="picture" onclick="submit()">
    <img src="./../hw3/<?=$value?>/overview.png" alt="hw3-img" />
</button>
    <?php
}}}
else {
  ?>
  <img src="./../hw3/<?=$_SESSION["pic"]?>/overview.png" alt="hw3-img" />
  <?php
}
?>
  </form>
<?php

}}
?>

  </body>
  <script>
  function submit(){
    console.log("button clicked");

  }
  </script>
</html>
