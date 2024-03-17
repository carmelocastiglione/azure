<?php
    $barcode = $_GET['barcode'];
    if ($barcode == 1) {
        echo "plastica";
    } elseif ($barcode == 2) {
        echo "vetro";
    } elseif ($barcode == 3) {
        echo "carta";
    } else {
        echo "not found";
    }
?>