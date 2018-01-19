<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 1/11/18
 * Time: 5:48 PM
 */
final class pdoController {

    public static function connectToDB ()
    {
        $albumShareDB = "mysql:dbname=albumShare;host=mysql";
        $dbUser = "developer";
        $dbPassword = "developer";

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