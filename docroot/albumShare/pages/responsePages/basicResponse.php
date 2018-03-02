<?php
/**
 * This page is here to have the functionality of saying "Thank you" waiting three seconds, and then redirecting to the
 * home page.
 */
$loot = $_SERVER['HTTP_HOST'];

echo "<h1>Thank You! Your submission is processed!</h1>";

header("refresh:3;url=phpTenPercent/docroot/albumShare/pages/home.php");



