
<h1>Hello</h1>


<?php
$serverName = trim($_SERVER['SERVER_NAME']);
echo "<h2>Server Name: " . $serverName . "</h2>";


if (strpos($serverName, 'localhost') !== false) {

} else {

}

try {
    echo 'Success';
    if (strpos($serverName, 'localhost') !== false) {
        $hostDB = "mysql";
        $dbPassword = "developer";
        $dbUser = "developer";
    } else {
        $hostDB = "localhost";
        $dbPassword = "Whitman1855";
        $dbUser = "root";
    }

    $albumShareDB = "mysql:dbname=albumShare;host=" . $hostDB;

    $connection = new PDO($albumShareDB, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}