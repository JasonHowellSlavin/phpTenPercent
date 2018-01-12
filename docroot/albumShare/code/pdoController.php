<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 1/11/18
 * Time: 5:48 PM
 */
class pdoController {
    $albumShareDB = 'mysql:dbname=albumShare;host=mysql';
    $dbUser = 'developer';
    $dbPassword = 'developer';

    public $dbConnection;

    private function _connectToDB ($connectVar) {
        $connectVar = new PDO($albumShareDB, $dbUser, $dbPassword);

        return $connectVar;
    }

    public function connectToDB () {
        return $this->_connectToDB($dbConnection);
    }

}