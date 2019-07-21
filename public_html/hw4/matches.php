<?php include "top.html";?>

    <form action="matches-submit.php" method="get">
    <fieldset>
    <legend>Returning User:</legend>
    <div>
    <label for="">Name:
        <input type="text" name="name">
    </label>
    </div>
        <input type="submit"  value="View My Matches">
</fieldset>
    </form>
<?php
function submit()
{
}
?>
<?php include "bottom.html";?>
