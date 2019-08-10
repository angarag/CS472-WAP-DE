 <?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=nerdluv;port=3306;host=127.0.0.1';
$user = 'match-maker';
$pass = 'meant2B';
include("./model/SinglesDAO.php");
$DAO=new SinglesDAO(new PDO($dsn, $user,  $pass));
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
      
function findMe($name,$password){
    global $DAO;
$me=$DAO->authenticate($name,$password);
session_start();
$_SESSION["me"]=$me;
}
function addSingle(){    global $DAO;

$userdata=$_POST;
$me=$DAO->addUser($userdata);

session_start();
$name=$_POST["name"];
$_SESSION["username"]=$name;
$_SESSION["matches"]=getMatches($me);

}
function getMatches($userdata){
    global $DAO;
return $DAO->getMatches($userdata);;
}

?>