<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 3/19/18
 * Time: 11:04 AM
 */
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $hash = (!empty($_POST['hash'])) ? $_POST['hash'] : '';
    $password = (!empty($_POST['password'])) ? $_POST['password'] : '';
    $rPassword = (!empty($_POST['rPassword'])) ? $_POST['rPassword'] : '';

    if ($password !== $rPassword) {
        echo "You passwords don't match or one is blank";
        include '../../code/includes/redirectToLogin.php';
    } elseif ($password === '' || $rPassword == '') {
        echo "You passwords don't match or one is blank";
        include '../../code/includes/redirectToLogin.php';
    } else {

        $getRecoverHashQuery = "SELECT userId, userPassword FROM userPasswords WHERE recoveryHash = ?";
        $getRecoverHashStmt = $connect->prepare($getRecoverHashQuery);
        $getRecoverHashStmt->bindParam(1, $hash);
        $recoveryHash = $hash;

        if ($getRecoverHashStmt->execute()) {
            $userInfo = $getRecoverHashStmt->fetch(PDO::FETCH_ASSOC);
            $id = $userInfo['userId'];
            $dbPassword = $userInfo['userPassword'];

            // Create a new PW for the DB
            $newPassword = password_hash($password, PASSWORD_DEFAULT);

            $updatePassWordQuery = "UPDATE userPasswords SET userPassword = ? WHERE userId = ?";
            $updatePassWordStmt = $connect->prepare($updatePassWordQuery);
            $updatePassWordStmt->bindParam(1, $currentPw);
            $updatePassWordStmt->bindParam(2, $userId);
            $currentPw = $newPassword;
            $userId = $id;

            if ($updatePassWordStmt->execute()) {
                $removeHashQuery = "UPDATE userPasswords SET recoveryHash = NULL WHERE primaryId = ?";
                $removeHashStmt = $connect->prepare($removeHashQuery);
                $removeHashStmt->bindParam(1, $idForRemove);
                $idForRemove = $id;
                $removeHashStmt->execute();
                echo "<h1> Your password has been reset! </h1>";
                include '../../code/includes/redirectToLogin.php';
            }
        }
    }
}
?>

<link rel="stylesheet" type="text/css" href="../../dist/css/login-page.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../dist/css/homepage.css">