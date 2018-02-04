
<h1>Hello</h1>

<?php

try {
    echo 'Success';
    $albumShareDB = "mysql:dbname=albumShare;host=localhost";
    $dbUser = "root";
    $dbPassword = "Whitman1855";

    $connection = new PDO($albumShareDB, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}