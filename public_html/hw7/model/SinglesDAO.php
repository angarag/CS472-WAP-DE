

<?php
class SinglesDAO{
    var $dbh;
    function __construct($db_conn){
        $this->dbh=$db_conn;
    }
public function authenticate($name, $password){
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt = $this->dbh->prepare("SELECT * FROM singles where name=:name and pass=:pass_hash");
$pass_hash = hash("sha256", $password . $name);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass_hash', $pass_hash);
$stmt->execute();
$me=$stmt->fetchAll();
$me=count($me)>0?$me[0]:null;
return $me?$me:false;
}
public function addUser($userdata){

      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt = $this->dbh->prepare("INSERT INTO singles VALUES (NULL, :name, :pass_hash, :gender, :age, :type1, :type2, :type3, :type4, :os, :min, :max)");
$password=$userdata["password"];
$name=$userdata["name"];
$gender=$userdata["gender"];
$age=$userdata["age"];
$ptypes=str_split($userdata["ptype"]);

$pass_hash = hash("sha256", $password . $name);


$stmt->bindParam(':name', $name);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':gender', $gender);
$stmt->bindValue(":age",$age);
$stmt->bindValue(":type1",$ptypes[0]);
$stmt->bindValue(":type2",$ptypes[1]);
$stmt->bindValue(":type3",$ptypes[2]);
$stmt->bindValue(":type4",$ptypes[3]);
$stmt->bindParam(':os', $userdata["os"]);
$stmt->bindParam(':min', $userdata["min"]);
$stmt->bindParam(':max', $userdata["max"]);
$stmt->bindParam(':pass_hash', $pass_hash);
 $stmt->execute();
return $this->authenticate($name,$password);
}
public function getMatches($userdata){

$this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt1=$this->dbh->prepare("SELECT * FROM singles WHERE gender <> :gender AND age >= :min AND age <= :max AND os = :os AND (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)");
$stmt1->bindParam(':gender', $userdata["gender"]);
$stmt1->bindParam(":type1",$userdata["type1"]);
$stmt1->bindParam(":type2",$userdata["type2"]);
$stmt1->bindParam(":type3",$userdata["type3"]);
$stmt1->bindParam(":type4",$userdata["type4"]);
$stmt1->bindParam(':os', $userdata["os"]);
$stmt1->bindParam(':min', $userdata["min"]);
$stmt1->bindParam(':max', $userdata["max"]);
$stmt1->execute();
$matches=$stmt1->fetchAll();
return $matches;
}
}
?>
