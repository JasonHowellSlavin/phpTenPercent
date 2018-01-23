<?php
require '../../code/pdo.php';
session_start();

$number =  $_POST["number-of-recs"];
$friendIDNum = $_POST["friendID"];

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";

$connect = pdoConnect::connectToDB();

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
    $currentUser = $id;
    $artist = $_POST["artistRec" . $i];
    $album = $_POST["albumRec" . $i];
    $recToID = $friendIDNum;
    $date = date("Y-m-d");
    $statementExe = $addRecToDb->execute();

    if (!$statementExe) {
        echo "Execute failed: "  . $addRecToDb->errorInfo();
    }
}

include "basicResponse.php";