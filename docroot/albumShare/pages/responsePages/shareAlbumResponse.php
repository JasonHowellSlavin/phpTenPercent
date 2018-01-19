<?php
require '../../code/pdoController.php';
session_start();

$number =  $_POST["number-of-recs"];
$friendIDNum = $_POST["friendID"];
$sessionUserID = $_SESSION['currentUser'];

$connect = pdoController::connectToDB();

if (!$connect) {
    echo "Could not connect";
};

$addRecToDb = $connect->prepare("INSERT INTO userRecommendations VALUES (null, ?, ?, ? ,?, ?)");

$addRecToDb->bindParam(1, $currentUser);
$addRecToDb->bindParam(2, $artist);
$addRecToDb->bindParam(3, $album);
$addRecToDb->bindParam(4, $recToID);
$addRecToDb->bindParam(5, $date);

for ($i = 0; $i < $number; $i++) {
    $currentUser = $sessionUserID;
    $artist = $_POST["artistRec" . $i];
    $album = $_POST["albumRec" . $i];
    $recToID = $friendIDNum;
    $date = date("Y-m-d");
    $statmentExe = $addRecToDb->execute();

    if (!$statmentExe) {
        echo "Execture failed: "  . $addRecToDb->errorInfo();
    }
}


include "basicReponse.php";