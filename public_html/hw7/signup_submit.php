<?php
include("./db-connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["name"] && $_POST["gender"] && $_POST["age"] && $_POST["ptype"]) {
        $comma = ",";
        $row = $_POST["name"] . $comma . $_POST["gender"] . $comma . $_POST["age"] . $comma . $_POST["ptype"] . $comma . $_POST["os"] . $comma . $_POST["min"] . $comma . $_POST["max"] . "\n";
     //   echo $row;
        $err_msgs=validateForm($_POST);
        if(count($err_msgs)==0){
        addSingle(true);
    header("Location: thank-you.php"); 

        }
           else{
            session_start();

$_SESSION["invalid_form"]=$err_msgs;
$_SESSION["form_values"]=$_POST;
 header("Location: signup.php");
        }
        // file_put_contents("./singles.txt", $row, FILE_APPEND);
    }

} else {
    echo 'HTTP GET NOT SUPPORTED';
                session_start();
$_SESSION["invalid_form"]=["HTTP GET NOT SUPPORTED"];
 header("Location: signup.php");
}

function validateForm($form){
    $err_msgs=array();
    list("name"=>$name,"password"=>$password,"gender"=>$gender,"age"=>$age,"ptype"=>$ptype,"os"=>$os,"min"=>$min,"max"=>$max)=$form;

    if(!preg_match("/(\w){2,} (\w){2,}/",$name) || preg_match("/,/",$name))
    $err_msgs[]="Username is invalid, it should contain at least two words";
    if(!preg_match("/[0-9a-zA-Z]{6,}/",$password) || preg_match("/,/",$password))
     $err_msgs[]="Password is invalid, it should be at least 6 characters";
    if(!preg_match("/^[MF]$/",$gender)|| preg_match("/,/",$gender))
    $err_msgs[]="Gender is invalid";
    if(!preg_match("/^[IE][NS][FT][JP]$/i",$ptype)|| preg_match("/,/",$ptype))
        $err_msgs[]="Personal type is invalid, It should be in the regex [IE][NS][FT][JP]";
    if(!preg_match("/^[1-9][0-9]/",$age)|| preg_match("/,/",$age))
        $err_msgs[]="Age is invalid, it should be in the range between 1-99";
    if(!preg_match("/^(Windows|Linux|Mac.OS)$/",$os)|| preg_match("/,/",$os))
        $err_msgs[]="OS is invalid, It should be Windows, Linux or Mac OS";
        if(!preg_match("/^[1-9]?[0-9]/",$min)|| preg_match("/,/",$min))
        $err_msgs[]="Min age is invalid, it should be in the range between 1-99";
        if(!preg_match("/^[1-9]?[0-9]/",$max)|| preg_match("/,/",$max))
  $err_msgs[]="Max age is invalid, it should be in the range between 1-99";
    return $err_msgs;
}
?>