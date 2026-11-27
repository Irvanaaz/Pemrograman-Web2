<?php
// Contoh penggunaan header Location

$a1 = 10;

if ($a1 < 0) {
    echo "Nilai A negatif";
} else {
    
    header("Location: test.php");
    exit; 
}
?>
