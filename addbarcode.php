<?php 
include ".env";

$name = $_GET["name"];
$barcode = $_GET["barcode"];
$type = $_GET["type"];

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
    $sql = "INSERT INTO barcodes (name, barcode, type) VALUES (?, ?, ?)";
    $params = array($name, $barcode, $type);
    if (($result = sqlsrv_query($conn, $sql, $params)) === false) {
        die (print_r(sqlsrv_errors(), true));
    }
    header('Location: index.php');
}
?>