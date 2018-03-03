<?php
require '../../code/pdo.php';
require '../../../vendor/autoload.php';
session_start();

use Mailgun\Mailgun;

$mgClient = new Mailgun('key-78901d2ba85f304101bd27611542885a');
$domain = "absh-www.jhslavin.com";

$number =  $_POST["number-of-recs"];
$friendIDNum = $_POST["friendID"];

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";

$connect = pdoConnect::connectToDB();

$getFriendID = $connect->prepare("SELECT * FROM users WHERE userId = ?;");
$getFriendID->bindParam(1,$friend);
$friend = $friendIDNum;
$getFriendIDStatement = $getFriendID->execute();
$friendData = $getFriendID->fetchAll(PDO::FETCH_ASSOC);

$friendName = $friendData[0]['userName'];
$friendEmail = $friendData[0]['userEmail'];

print_r($friendData);

echo '<h1> Friend name ' . $friendName . $friendEmail . '</h1>';


$message = "
   <html>
    <head>
        <title>You have new recommendations from " . $name . "</title>
    </head>
    <body>
        <table style='border-spacing:20px;'>
            <tbody>
                <tr>
                   <td> Hey " . $friendName . "
                   </td>
                </tr>
                <tr>
                    <td style='margin-top: 20px;'>
                    You just got some new recs! Go check em out at: http://ec2-52-203-38-207.compute-1.amazonaws.com/phpTenPercent/docroot/albumShare/pages/loginPages/initialLogin.php
                    </td>
                </tr>
            </tbody>
    </body>
";

try {
    $result = $mgClient->sendMessage($domain, array(
        'from'    => 'albumShare <rockNRolla@absh-www.jhslavin.com>',
        'to'      => $friendEmail,
        'subject' => 'You Have Some New Album Recommendations from ' . $name .  '!',
        'html'    => $message,
    ));
} catch (Exception $e){
    echo "Humphrey, $e";
};






$addRecToDb = $connect->prepare("INSERT INTO userRecommendations VALUES (null, ?, ?, ? ,?, ?, ?)");

$addRecToDb->bindParam(1, $currentUser);
$addRecToDb->bindParam(2, $artist);
$addRecToDb->bindParam(3, $album);
$addRecToDb->bindParam(4, $recToID);
$addRecToDb->bindParam(5, $date);
$addRecToDb->bindParam(6,$theme);

for ($i = 0; $i < $number; $i++) {
    $currentUser = $id;
    $artist = $_POST["artistRec" . $i];
    $album = $_POST["albumRec" . $i];
    $recToID = $friendIDNum;
    $date = date("Y-m-d");
    $theme = $_POST['theme'];
    $statementExe = $addRecToDb->execute();

    if (!$statementExe) {
        echo "Execute failed: "  . $addRecToDb->errorInfo();
    }
}

include "basicResponse.php";