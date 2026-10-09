<!DOCTYPE html>
<html>
<HEAD>
    <TITLE>Penggunaan Is Array</TITLE>
</HEAD>
<BODY>
<?php
$var = array(1,2,3,4,5,6,7);
$scan = is_array($var);

if ($scan == false) {
    $status = "BUKAN";
} else {
    $status = "ADALAH";
}

echo "\$var = array(1,2,3,4,5,6,7)";
echo "<br>";
echo "Variabel \$var <b>$status</b> merupakan array";
?>
</BODY>
</html>