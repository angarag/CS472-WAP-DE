<?php include "../hw4/top.html";
include("./db-connection.php");
findMe();
session_start();
$me_found=(isset($_SESSION["me"]) && $_SESSION["me"]!=null)?$_SESSION["me"]:null;
if($me_found==null)
header("Location: login.php?message=notfound");
else{
  $_SESSION["username"]=$_SESSION["me"]["name"];
  $_SESSION["matches"]=getMatches();
  header("Location: view-match.php");
}
?>
