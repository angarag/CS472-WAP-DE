<?php include "top.html";?>

<h1><?="Matches for " . $_GET["name"]?></h1>
<?php
$name = $_GET["name"] ? $_GET["name"] : "Alan Turing";
$lines = file("./singles.txt");
$me = null;
foreach ($lines as $line) {
    $params = explode(",", $line);
    if ($params[0] == $name) {
        $me = $params;
        break;
    }
}
$matches = array();
$me_ptype = str_split($me[3]);
foreach ($lines as $line) {
    $params = explode(",", $line);
    if ($params[0] != $me[0]) {
        if ($params[1] != $me[1]) {
            if ((int) $params[2] <= (int) $me[6] && (int) $params[2] >= (int) $me[5]) {
                if ($params[4] == $me[4]) {
                    foreach ($me_ptype as $type) {
                        if (strpos($params[3], $type) !== false) {
                            $matches[] = $params;
                            break;
                        }
                    }
                }
            }
        }
    }
}
foreach ($matches as $match) {
    ?>
<div class="match">
  <img src="./images/user.jpg" alt="" />
  <p><?=$match[0]?></p>
  <ul>
    <li>
      <span class="label.left"><strong>gender:</strong><?=$match[1]?></span>
    </li>
    <li>
      <span class="label.left"><strong>age:</strong><?=$match[2]?></span>
    </li>
    <li>
      <span class="label.left"><strong>type:</strong><?=$match[3]?></span>
    </li>
    <li>
      <span class="label.left"><strong>OS:</strong><?=$match[4]?></span>
    </li>
  </ul>
</div>

    <?php
}
?>
<?php include "bottom.html";?>
