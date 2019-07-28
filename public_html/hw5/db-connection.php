 <?php

function addSingle(){
 $db_pass=$_POST["db_pass"];
      $dbh = new PDO("mysql:dbname=nerdluv;host=localhost", "root",  $db_pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt = $dbh->prepare("INSERT INTO singles VALUES (NULL, :name, :pass_hash, :gender, :age, :type1, :type2, :type3, :type4, :os, :min, :max)");
$password=$_POST["password"];
$name=$_POST["name"];
$pass_hash = hash("sha256", $password . $name);
$gender=$_POST["gender"];
$age=$_POST["age"];
$ptypes=str_split($_POST["ptype"]);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':gender', $gender);
$stmt->bindValue(":age",$age);
$stmt->bindValue(":type1",$ptypes[0]);
$stmt->bindValue(":type2",$ptypes[1]);
$stmt->bindValue(":type3",$ptypes[2]);
$stmt->bindValue(":type4",$ptypes[3]);
$stmt->bindParam(':os', $_POST["os"]);
$stmt->bindParam(':min', $_POST["min"]);
$stmt->bindParam(':max', $_POST["max"]);
$stmt->bindParam(':pass_hash', $pass_hash);

$stmt->execute();
}

function getMatches(){
      $db_pass=$_POST["db_pass"];
      $dbh = new PDO("mysql:dbname=nerdluv;host=localhost", "root",  $db_pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt = $dbh->prepare("SELECT * FROM singles WHERE name = :name AND pass =:pass_hash");
$name=$_POST["name"];
$password=$_POST["password"];
$pass_hash = hash("sha256", $password . $name);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass_hash', $pass_hash);
$stmt->execute();
$me=$stmt->fetchAll();
$me=$me[0];
$stmt1=$dbh->prepare("SELECT * FROM singles WHERE gender <> :gender AND age >= :min AND age <= :max AND os = :os AND (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)");
$stmt1->bindParam(':gender', $me["gender"]);
$stmt1->bindParam(":type1",$me["type1"]);
$stmt1->bindParam(":type2",$me["type2"]);
$stmt1->bindParam(":type3",$me["type3"]);
$stmt1->bindParam(":type4",$me["type4"]);
$stmt1->bindParam(':os', $me["os"]);
$stmt1->bindParam(':min', $me["min"]);
$stmt1->bindParam(':max', $me["max"]);
$stmt1->execute();
$matches=$stmt1->fetchAll();
return $matches;
}
?>