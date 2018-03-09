<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 3/6/18
 * Time: 9:23 AM
 */
$serverName = trim($_SERVER['SERVER_NAME']);

if (strpos($serverName, 'localhost') !== false) {
    header("refresh:3;url=../home.php");
} else {
    header("refresh:3;url=http://ec2-52-203-38-207.compute-1.amazonaws.com/phpTenPercent/docroot/albumShare/pages/home.php");
}