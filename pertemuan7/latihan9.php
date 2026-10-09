<!DOCTYPE html>
<html>
<HEAD>
    <TITLE>Penggunaan In Array</TITLE>
</HEAD>
<BODY>
<?php
$program = array("HTML", "PHP", "CSS", "JavaScript");
print_r($program);
echo "<br><br>";

$cari = "HTML";
if (in_array($cari, $program)) {
    echo "Program Basis Web <b>$cari</b> ada di dalam array";
} else {
    echo "Program Basis Web <b>$cari</b> tidak ada di dalam array";
}
?>
</BODY>
</html>