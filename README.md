# azure

Per lavorare in locale, creare un file .env contenente:

<?php
putenv("AZURE_DB_SERVER=<indirizzodelserverdb>");
putenv("AZURE_DB_PORT=<portadelserverdb>");
putenv("AZURE_DB_NAME=<nomedeldb>");
putenv("AZURE_DB_USER=<username>");
putenv("AZURE_DB_PASS=<password>");
?>

Per lavorare su Azure, impostare le precedenti come variabili di ambiente per l'App Web