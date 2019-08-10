<?php include("../hw4/top.html"); ?>
<?php require("./controller/login-controller.php");?>
<?php

if(parseMessage()){

?>
<p style="color:red"><?=parseMessage()?></p>
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

<?php include("../hw4/bottom.html"); ?>
