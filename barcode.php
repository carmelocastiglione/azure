<?php 
include ".env";

$barcode = $_GET["barcode"];

$connectionInfo = array(
  "UID" => "" . getenv("AZURE_DB_USER") . "", 
  "pwd" => "" . getenv("AZURE_DB_PASS") . "", 
  "Database" => "" . getenv("AZURE_DB_NAME") . "", 
  "LoginTimeout" => 30, 
  "Encrypt" => 1, 
  "TrustServerCertificate" => 0);
$serverName = "" . getenv("AZURE_DB_SERVER") . "," . getenv("AZURE_DB_PORT") . "";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn) {
    $sql = "SELECT id, name, barcode, type FROM barcodes WHERE barcode='$barcode'";
    if (($result = sqlsrv_query($conn, $sql)) === false) {
        die (print_r(sqlsrv_errors(), true));
    }
    $obj = sqlsrv_fetch_object( $result );
    if ($obj !== null) {
        echo $obj->type;
    } else {
        echo 'not found';
    }
}
?>