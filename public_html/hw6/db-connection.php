 <?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=nerdluv;port=3306;host=127.0.0.1';
$user = 'match-maker';
$pass = 'meant2B';

try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
      
function findMe(){
                  global $user, $pass,$dsn;
      $dbh = new PDO($dsn, $user,  $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
$stmt = $dbh->prepare("SELECT * FROM singles where name=:name and pass=:pass_hash");
$password=$_POST["password"];
$name=$_POST["name"];
$pass_hash = hash("sha256", $password . $name);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':pass_hash', $pass_hash);
$stmt->execute();
$me=$stmt->fetchAll();
$me=count($me)>0?$me[0]:null;
session_start();
$_SESSION["me"]=$me;
}

function getMatches(){
                  global $user, $pass,$dsn;

$dbh = new PDO($dsn, $user,  $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
session_start();
$me=$_SESSION["me"];
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