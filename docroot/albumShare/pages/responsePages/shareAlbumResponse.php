<?php
session_start();
var_dump($_REQUEST);
$number =  $_POST["f"];
echo "<h1> Number or recs sent from previous page" . $number ."</h1>";



echo "<h1> Current USer" . $_SESSION['currentUser'] . "</h1>";

$albumShareDB = 'mysql:dbname=albumShare;host=mysql';
$dbUser = 'developer';
$dbPassword = 'developer';

// Here is where I am taking the array passed from post and inserting the variable sinto the DB using the for loop. 

$connect = new PDO($albumShareDB, $dbUser, $dbPassword);

$addRecToDb = $connect->prepare("INSERT INTO userRecommendations VALUES (null, ?, ?, ? ,?)");

for ($i = 0; $i < $number; $i++) {
    $addRecToDb->bindParam(1, $_SESSION['currentUser']);
    $addRecToDb->bindParam(2, $_POST["artistRec" . $i]);
    $addRecToDb->bindParam(2, $_POST["artistRec" . $i]);
    $addRecToDb->bindParam(2, $_POST["artistRec" . $i]);
    $addRecToDb->bindParam(2, $_POST["artistRec" . $i]);
}


//include "basicReponse.php";