<?php

try {
$dsn = 'mysql:dbname=nerdluv;port=3306;host=127.0.0.1';
$user = 'root';
$pass = '';
$dbh=new PDO($dsn,$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$dbh->prepare("select name, max(age) - min(age) as diff from singles order by age desc");
echo $stmt->execute();
$arr=$stmt->fetchAll();
var_dump($arr);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>