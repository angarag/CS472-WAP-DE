<?php
include("../hw5/db-connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["name"] && $_POST["gender"] && $_POST["age"] && $_POST["ptype"]) {
        $comma = ",";
        $row = $_POST["name"] . $comma . $_POST["gender"] . $comma . $_POST["age"] . $comma . $_POST["ptype"] . $comma . $_POST["os"] . $comma . $_POST["min"] . $comma . $_POST["max"] . "\n";
        // echo $row;
        addSingle(true);
        // file_put_contents("./singles.txt", $row, FILE_APPEND);
    }
    header("Location: thank-you.php");
} else {
    echo 'GET not supported';
}
?>