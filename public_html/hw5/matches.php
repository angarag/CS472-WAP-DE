<?php include("../hw4/top.html"); ?>

    <form action="matches-submit.php" method="post">
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
        <input type="hidden" name="db_pass" value="">
</fieldset>
    </form>
<?php
function submit()
{
}
?>
<?php include("../hw4/bottom.html"); ?>
