
<h1>Hello</h1>

<?php

try {
    $albumShareDB = "mysql:dbname=albumShare;host=localhost";
    $dbUser = "root";
    $dbPassword = "developer";

    $connection = new PDO($albumShareDB, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}