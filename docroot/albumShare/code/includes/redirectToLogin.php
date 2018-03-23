<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 3/21/18
 * Time: 12:08 PM
 */
$serverName = trim($_SERVER['SERVER_NAME']);

if (strpos($serverName, 'localhost') !== false) {
    header("refresh:3;url=../loginPages/initialLogin.php");
} else {
    header("refresh:3;url=http://ec2-52-203-38-207.compute-1.amazonaws.com/phpTenPercent/docroot/albumShare/pages/loginPages/initialLogin.php");
}