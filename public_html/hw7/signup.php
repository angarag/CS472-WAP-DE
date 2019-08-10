<?php include("../hw4/top.html"); ?>

<?php

session_start();
if(isset($_SESSION["invalid_form"])){
  $err_msgs=$_SESSION["invalid_form"];
  unset($_SESSION["invalid_form"]);
  foreach($err_msgs as $msg){
      ?>
<a style="display:block" href="#"><?=$msg?></a>
<?php }}
$arr=array();

if(isset($_SESSION["form_values"])){
  $arr=$_SESSION["form_values"];
}
else {
$arr["name"]="";
$arr["password"]="";
$arr["gender"]="";
$arr["age"]="";
$arr["min"]="";
$arr["max"]="";
$arr["os"]="";
$arr["ptype"]="";
}
?>

<form action="signup_submit.php" method="post">
  <fieldset>
    <legend>New User Signup:</legend>
    <div class="match">
      <span class="column">Name:</span>
      <input type="text" name="name" id="name" maxlength="16" class="sixteen" value="<?=$arr["name"]?>"/>
    </div>
    <div class="match">
      <span class="column">Password:</span>
      <input type="password" name="password" class="sixteen" value="<?=$arr["password"]?>">
    </div>
    <div class="match">
      <span class="column">Gender:</span>
      <input type="radio" name="gender" id="gender" value="M" <?=($arr["gender"]=="M")?"checked":""?>/>
      <label for="gender">Male</label>
      <label><input type="radio" name="gender" <?=($arr["gender"]=="F" || $arr["gender"]=="")?"checked":""?> value="F"/>Female</label>
    </div>
    <div class="match">
      <span class="column">Age:</span>
      <input type="text" name="age" maxlength="2" class="six" value="<?=$arr["age"]?>"/>
    </div>
    <div class="match">
      <span class="column">Personality type:</span>
      <input type="text" name="ptype" maxlength="4" class="six" value="<?=$arr["ptype"]?>"/>
      (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp" target="_blank"> <span>Don't know your type?</span> </a>)
    </div>
    <div class="match">
      <span class="column">Favorite OS:</span>
      <select name="os">
          <option <?=($arr["os"]=="Linux")?"selected":""?>>Linux</option>
        <option <?=($arr["os"]=="Windows" || $arr["os"]=="")?"selected":""?>>Windows</option>
        <option <?=($arr["os"]=="Mac OS")?"selected":""?>>Mac OS</option>
      </select>
    </div>
    <div class="match">
      <span class="column">Seeking age:</span>
      <div class="column">
        <input class="six" maxlength="2" style="width:39%" type="text" placeholder="min" name="min" value="<?=$arr["min"]?>"/> to
        <input class="six" maxlength="2" style="width:39%" type="text" placeholder="max" name="max" value="<?=$arr["max"]?>"/>
      </div>
    </div>
    <div class="match">
      <input class="column" type="submit" value="Sign Up" />
    </div>
    <input type="hidden" name="db_pass" value="meant2B">
  </fieldset>
</form>
<?php
?>

<?php include("../hw4/bottom.html"); ?>
