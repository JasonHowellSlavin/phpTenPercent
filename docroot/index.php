
<h1>Hello</h1>


<?php

echo "<h2>Server Name: " . $_SERVER['SERVER_NAME'] . "</h2>";

try {
    echo 'Success';
    $albumShareDB = "mysql:dbname=albumShare;host=localhost";
    $dbUser = "root";
    $dbPassword = "Whitman1855";

    $connection = new PDO($albumShareDB, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}