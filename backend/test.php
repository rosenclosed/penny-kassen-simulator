<?php

if (isset($_GET['ean13'])) {
    $ean13 = $_GET['ean13'];
    echo "EAN13: " . htmlspecialchars($ean13);
}

if (isset($_GET['ean8'])) {
    $ean8 = $_GET['ean8'];
    echo "EAN8: " . htmlspecialchars($ean8);
}

if (isset($_GET['plu'])) {
    $plu = $_GET['plu'];
    echo "PLU: " . htmlspecialchars($plu);
}

if (isset($_GET['nan'])) {
    $nan = $_GET['nan'];
    echo "NAN: " . htmlspecialchars($nan);
}



?>