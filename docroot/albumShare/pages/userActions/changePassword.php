<?php
session_start();
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

$name = $_SESSION["userName"];
$id = $_SESSION["userId"];
$email = $_SESSION["userEmail"];
$hashedPassword = "";

$currentPassword = $newPassword = $repeatNewPassword = "";
$currentPasswordErr = $newPasswordErr = $repeatNewPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    function checkIfEmpty(&$postData, &$globalVar, &$globalVarErr)
    {
        (empty(trim($postData))) ? $globalVarErr = "the input was empty" : $globalVar = $postData;
    }

    checkIfEmpty($_POST["current-password"], $currentPassword, $currentPasswordErr);
    checkIfEmpty($_POST["new-password"], $newPassword, $newPasswordErr);
    checkIfEmpty($_POST["repeat-new-password"], $repeatNewPassword, $repeatNewPasswordErr);

    if (empty(trim($currentPasswordErr)) && empty(trim($newPasswordErr)) && empty(trim($repeatNewPasswordErr))) {

        $retrievePwQuery = "SELECT userPassword FROM userPasswords WHERE userId = ?";
        if ($retrieveStmt = $connect->prepare($retrievePwQuery)) {
            $retrieveStmt->bindParam(1, $userID);
            $userID = $id;

            if ($retrieveStmt->execute()) {
                $hashedPassword = $retrieveStmt->fetch()["userPassword"];
            }

            //check to see if the input matches the fetched password
            if (password_verify($currentPassword, $hashedPassword)) {
                if ($newPassword == $repeatNewPassword) {
                    $updateQuery = "UPDATE userPasswords SET userPassword = ? WHERE userId = ?";
                    if ($updateStmt = $connect->prepare($updateQuery)) {
                        $updateStmt->bindParam(1, $updatePass);
                        $updateStmt->bindParam(2, $updateId);
                        $updatePass = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateId = $id;

                        if ($updateStmt->execute()) {

                            echo "Success, your password has been updated!";

                            header("refresh:3;url=http://" . $_SERVER['HTTP_HOST'] . "/albumShare/pages/home.php");
                        }
                    }
                } else {
                    echo "Sorry, your new password doesn't match";
                }

            } else {
                echo "Sorry, that wasn't the correct password";
            }
        }

    } else {
        echo "Ooopsie, there was an error somewhere. Did you fill out all of the fields?";
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../dist/css/login-page.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

<article>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="current-password">Current Password</label>
        <input type="password" name="current-password">
        <label for="new-password">New Password</label>
        <input type="password" name="new-password">
        <label for="repeat-new-password">Repeat New Password</label>
        <input type="password" name="repeat-new-password">
        <input type="submit" value="Change Password">
    </form>
</article>
