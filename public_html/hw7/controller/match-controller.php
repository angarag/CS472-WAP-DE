<?php

function getMatches(){
return $_SESSION["matches"];

}

function getCurrentMatchArrayIndex(){
    return isset($_GET["match"])?$_GET["match"]:0;
}

?>