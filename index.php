<?php 
include ".env";
$connectionInfo = array(
  "UID" => "" . getenv("AZURE_DB_USER") . "", 
  "pwd" => "" . getenv("AZURE_DB_PASS") . "", 
  "Database" => "" . getenv("AZURE_DB_NAME") . "", 
  "LoginTimeout" => 30, 
  "Encrypt" => 1, 
  "TrustServerCertificate" => 0);
$serverName = "" . getenv("AZURE_DB_SERVER") . "," . getenv("AZURE_DB_PORT") . "";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode management</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="display-1">Barcode management</h1>
    <h2>Users</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">code</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if ($conn) {
          $sql = "SELECT id, name, code FROM users";
          if (($result = sqlsrv_query($conn, $sql)) === false) {
            die (print_r(sqlsrv_errors(), true));
          }
          while( $obj = sqlsrv_fetch_object( $result )) {
            echo '<tr>';
            echo '<th scope="row">'.$obj->id.'</th>';
            echo '<td>'.$obj->name.'</td>';
            echo '<td>'.$obj->code.'</td>';
            echo '<td>
            <form action="deleteuser.php" method="GET">
            <input type="hidden" name="id" value="'.$obj->id.'">
            <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
            </td>';
            echo '</tr>';
          }
        }
        ?>
        <form action="adduser.php" method="GET">
          <tr>
            <th></th>
            <td>
              <input type="text" class="form-control" id="name" name="name">
            </td>
            <td>
              <input type="text" class="form-control" id="code" name="code">
            </td>
            <td>
              <button type="submit" class="btn btn-success">Aggiungi</button>
            </td>
          </tr>
        </form>
      </tbody>
    </table>

    <h2>Barcodes</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">barcode</th>
          <th scope="col">type</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if ($conn) {
          $sql = "SELECT id, name, barcode, type FROM barcodes";
          if (($result = sqlsrv_query($conn, $sql)) === false) {
            die (print_r(sqlsrv_errors(), true));
          }
          while( $obj = sqlsrv_fetch_object( $result )) {
            echo '<tr>';
            echo '<th scope="row">'.$obj->id.'</th>';
            echo '<td>'.$obj->name.'</td>';
            echo '<td>'.$obj->barcode.'</td>';
            echo '<td>'.$obj->type.'</td>';
            echo '<td>
            <form action="deletebarcode.php" method="GET">
            <input type="hidden" name="id" value="'.$obj->id.'">
            <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
            </td>';
            echo '</tr>';
          }
        }
        ?>
        <form action="addbarcode.php" method="GET">
          <tr>
            <th></th>
            <td>
              <input type="text" class="form-control" id="name" name="name">
            </td>
            <td>
              <input type="text" class="form-control" id="barcode" name="barcode">
            </td>
            <td>
              <select class="form-select" aria-label="Type select" name="type" id="type">
                <option selected></option>
                <option value="plastica">Plastica</option>
                <option value="vetro">Vetro</option>
                <option value="carta">Carta</option>
              </select>
            </td>
            <td>
              <button type="submit" class="btn btn-success">Aggiungi</button>
            </td>
          </tr>
        </form>
      </tbody>
    </table>
  </div>
  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>