<?php 

function getUsername(){
        session_start();
    return $_SESSION["username"];
}

function checkIfUserLoggedIn(){
    session_start();
$username=$_SESSION["username"];
if(!$username){
header("Location: login.php?message=loginFirst");
}
return true;
}
?>