<?php
include("./helper.php");
print($method);

$input=($_POST["mars"]);
echo $input."\n";
file_put_contents("./formatted.txt",htmlspecialchars($input),FILE_APPEND);
file_put_contents("./unformatted.txt",($input),FILE_APPEND);
foreach(glob("./*formatted.txt") as $file){
    echo $file."\n";
   echo file_get_contents($file);
   echo "\n";
}
if(is_uploaded_file($_FILES["mars_file"]))
print_r($_FILES["mars_file"]);
var_dump($_FILES["mars_file"]);
//header("Location: turnin_main.php?param=".$input);
//exit(0);
?>