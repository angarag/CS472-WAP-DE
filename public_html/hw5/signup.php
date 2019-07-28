<?php include("../hw4/top.html"); ?>

<?php

    ?>

<form action="signup_submit.php" method="post">
  <fieldset>
    <legend>New User Signup:</legend>
    <div class="match">
      <span class="column">Name:</span>
      <input type="text" name="name" id="name" maxlength="16" class="sixteen"/>
    </div>
    <div class="match">
      <span class="column">Password:</span>
      <input type="password" name="password" class="sixteen">
    </div>
    <div class="match">
      <span class="column">Gender:</span>
      <input type="radio" name="gender" id="gender" value="M"/>
      <label for="gender">Male</label>
      <label><input type="radio" name="gender" checked value="F"/>Female</label>
    </div>
    <div class="match">
      <span class="column">Age:</span>
      <input type="text" name="age" maxlength="2" class="six"/>
    </div>
    <div class="match">
      <span class="column">Personality type:</span>
      <input type="text" name="ptype" maxlength="4" class="six"/>
      (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp" target="_blank"> <span>Don't know your type?</span> </a>)
    </div>
    <div class="match">
      <span class="column">Favorite OS:</span>
      <select name="os">
          <option>Linux</option>
        <option selected>Windows</option>
        <option>Mac OS</option>
      </select>
    </div>
    <div class="match">
      <span class="column">Seeking age:</span>
      <div class="column">
        <input class="six" maxlength="2" style="width:39%" type="text" placeholder="min" name="min" /> to
        <input class="six" maxlength="2" style="width:39%" type="text" placeholder="max" name="max" />
      </div>
    </div>
    <div class="match">
      <input class="column" type="submit" value="Sign Up" />
    </div>
    <input type="hidden" name="db_pass" value="">
  </fieldset>
</form>
<?php
?>

<?php include("../hw4/bottom.html"); ?>
