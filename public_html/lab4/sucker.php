<!DOCTYPE html>
<html>
  <head>
    <title>Thanks sucker</title>
    <link href="./buyagrade.css" type="text/css" rel="stylesheet" />
  </head>

  <body>
      <?php
function checkLuhn($purportedCC)
{
    $sum = (int) ($purportedCC[strlen($purportedCC) - 1]);
    $nDigits = strlen($purportedCC);
    $parity = $nDigits % 2;
    for ($i = 0; $i <= $nDigits - 2; $i++) {
        $digit = (int) $purportedCC[$i];
        if ($i % 2 == $parity) {
            $digit = $digit * 2;
        }

        if ($digit > 9) {
            $digit = $digit - 9;
        }

        $sum += $digit;
    }
    return ($sum % 10) == 0;
}
if ($_POST["name"] && $_POST["section"] && $_POST["credit_number"] && $_POST["credit_card"]) {
    $valid = true;
} else {
    $valid = false;
}

?>
      <?php
if ($valid) {
    $card_type = $_POST["credit_card"];
    $card_number = $_POST["credit_number"];
    $text = "You didn't fill out the form completely.<a href=\"./buyagrade.html\">Try again?</a>";
    $is_card_valid = false;
    if (strlen($card_number) == 16 && (($card_type == "visa" && $card_number[0] == '4') || ($card_number[0] == '5' && $card_type == "mastercard"))) {
        $is_card_valid = true;
    }

    if (!$is_card_valid) {
        $text = "You didn't provide a valid card number.<a href=\"./buyagrade.html\">Try again?</a>";
        $valid = false;
    } else {
        if (!checkLuhn($card_number)) {
            $text = "You didn't provide a valid card number.<a href=\"./buyagrade.html\">Try again?</a>";
            $valid = false;
        }

    }
}
if (!$valid) {
    ?>
      <p><?=$text?></p>
      <?php } else {?>
      <h1>Thanks, sucker!</h1>
      <p>Your information has been recorded.</p>
      <dl>
        <dt>Name</dt>
        <dd>
          <?=$_POST["name"]?>
        </dd>

        <dt>Section</dt>
        <dd>
        <?=$_POST["section"]?>
        </dd>
        <dt>Credit Card</dt>
        <dd>
        <?=$_POST["credit_number"] . "(" . $_POST["credit_card"] . ")"?>
        </dd>
      </dl>
  <?php
$divider = ";";
    $file_name = "singles.txt";
    $row = $_POST["name"] . $divider . $_POST["section"] . $divider . $_POST["credit_number"] . $divider . $_POST["credit_card"] . "\n";
    if (!file_exists($file_name)) {
        $file = fopen($file_name, "w");
        fclose($file);
    }
    file_put_contents($file_name, $row, FILE_APPEND);
    ?>
<p>Here are all the suckers who have submitted here:</p>
<pre><?=file_get_contents($file_name)?></pre>
      <?php }?>
</body>
</html>