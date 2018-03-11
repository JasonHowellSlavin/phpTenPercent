<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 3/10/18
 * Time: 3:05 PM
 */

// What does this endpoint need to do?

// Take the post data from the ajax request - specifically the email

// Use the email to generate a random hash

// add that random hash to the db

// create an email message for the password recovery where the address is
// domain/pages/loginPages/passwordRecovery?recovery=hash?email=email

// send that message to the recovery email

//require our PDO class
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

//require and create the Mailgun Object
require '../../../vendor/autoload.php';
use Mailgun\Mailgun;
$mgClient = new Mailgun('key-78901d2ba85f304101bd27611542885a');
$domain = "absh-www.jhslavin.com";

if ($_SERVER["REQUEST_METHOD"] === "POST" ) {

    if ($_POST['action'] === 'recoverPassword') {

        $recoveryEmail = $_POST['email'];


        $bytes = openssl_random_pseudo_bytes(22,$csstrong);
        $randomHash = bin2hex($bytes);

        // use the email to get the id
        $getUserIdQuery = "SELECT userId FROM users WHERE userEmail = ?;";
        if ($getUserIdStmt = $connect->prepare($getUserIdQuery)) {
            $getUserIdStmt->bindParam(1, $userEmail);
            $userEmail = $recoveryEmail;
            $getUserIdStmt->execute();
            $userId = $getUserIdStmt->fetch(PDO::FETCH_ASSOC)['userId'];
        }

        //insert the same hash we will use for the email into the db
        $insertHashQuery = "UPDATE userPasswords SET recoveryHash = ? WHERE primaryId = ?;";
        if ($insertHashStmt = $connect->prepare($insertHashQuery)) {
            $insertHashStmt->bindParam(1,$hash);
            $insertHashStmt->bindParam(2,$id);
            $hash = $randomHash;
            $id = $userId;
            $insertHashStmt->execute();
        }

        //Now that the has is inserted, construct our url
        $serverName = trim($_SERVER['SERVER_NAME']);
        $productionServer = "http://http://ec2-52-203-38-207.compute-1.amazonaws.com/phpTenPercent/docroot/albumShare/pages/loginPages";
        $recoveryEmailParams = "passwordRecovery.php?recovery=" . $randomHash . "&email=" . $recoveryEmail . "&id=" . $userId;

        if (strpos($serverName, 'localhost') !== false) {
            // We local
            $emailUrl = "http://localhost/albumShare/pages/loginPages/" . $recoveryEmailParams;
        } else {
           // We on prod
            $emailUrl = $productionServer . $recoveryEmailParams;
        }

        //Now that we have our hash in the db, and we have our url, we need to create the message and send the email.
        $recoveryMessage = "
            <html>
            <head>
                <title>Here is your password recovery link</title>
            </head>
            <body>
                <table style='border-spacing:20px;'>
                    <tbody>
                        <tr>
                            <td style='margin-top: 20px;'>
                            Click on this link to recover your password $emailUrl
                            </td>
                        </tr>
                    </tbody>
            </body>
        ";

        if (strpos($serverName, 'localhost') === false) {
            try {
                $result = $mgClient->sendMessage($domain, array(
                    'from' => 'albumShare <rockNRolla@absh-www.jhslavin.com>',
                    'to' => $recoveryEmail,
                    'subject' => 'Password Recovery from albumShare',
                    'html' => $recoveryMessage,
                ));
            } catch (Exception $e) {
                echo "Email Failed, $e";
            };
        } else {
            // We are local, send all tests to me.
            try {
                $result = $mgClient->sendMessage($domain, array(
                    'from' => 'albumShare <rockNRolla@absh-www.jhslavin.com>',
                    'to' => 'slavin.jhs@gmail.com',
                    'subject' => 'Password Recovery from albumShare',
                    'html' => $recoveryMessage,
                ));
            } catch (Exception $e) {
                echo "Email Failed, $e";
            };
        }


//        $query = "SELECT * FROM userRecommendations WHERE userId = ? AND recommendedTo = ?;";
//        if ($stmt = $connect->prepare($query)) {
//            $stmt->bindParam(1,$userID);
//            $stmt->bindParam(2,$recommendedID);
//            $userID = $recommender;
//            $recommendedID = $reccommendedTo;
//            $stmt->execute();
//
//            $jsonReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        }
//    }

        echo json_encode($userId);
    }
};