<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 1/23/18
 * Time: 9:58 AM
 */
$_SESSION = array();

session_destroy();

header("Location: ../loginPages/initialLogin.php");