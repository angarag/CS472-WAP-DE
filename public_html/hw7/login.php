<?php include("../hw4/top.html"); ?>
<?php

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
?>
<p style="color:red"><?=$msg?></p>
<?php
}
else {

}
?>
    <form action="login-submit.php" method="post">
    <fieldset>
    <legend>Returning User:</legend>
    <div>
    <label for="name">Name:
    </label>
        <input type="text" name="name">
    </div>
<div>
    <label for="text">Password:</label>
        <input type="password" name="password">
</div>
        <input type="submit"  value="View My Matches">
</fieldset>
    </form>
<?php
function submit()
{
}
?>
<?php include("../hw4/bottom.html"); ?>
