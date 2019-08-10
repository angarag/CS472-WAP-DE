<?php include "../hw4/top.html";
include("./db-connection.php");
findMe($_POST["name"],$_POST["password"]);
session_start();
$me_found=(isset($_SESSION["me"]) && $_SESSION["me"]!=null)?$_SESSION["me"]:null;
if($me_found==null)
header("Location: login.php?message=notfound");
else{

  $_SESSION["username"]=$_SESSION["me"]["name"];
  $matches=getMatches($me_found);

  $_SESSION["matches"]=$matches;
  header("Location: view-match.php");
}
?>
