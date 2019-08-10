<?php
function parseMessage(){
    $msg=null;
    if(isset($_GET["message"])){
    switch($_GET["message"]){
        case "notfound":
        $msg="Invalid username or password";
        break;
        case "loginFirst":
        $msg="Please login first";
        break;
        default: 
        $msg="Unknown message";
    }
    return $msg;
}
}
?>