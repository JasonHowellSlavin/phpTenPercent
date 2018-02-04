<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 1/11/18
 * Time: 5:48 PM
 */
final class pdoConnect {
    public static function connectToDB ()
    {
        $serverName = trim($_SERVER['SERVER_NAME']);

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

        return $connection;
    }

    private function __construct()
    {

    }

    private function __clone()
    {

    }
}