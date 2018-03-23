<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

$email = $password = "";
$emailErr = $passwordErr = "";
$thisID = "";
$hashedPassword = "";
$userName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    if(empty(trim($_POST["email"]))) {
        $emailErr = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter a password";
    } else {
        $password = $_POST["password"];
    }

    if (empty($emailErr) && empty($passwordErr)) {
        // we have to check if the user is in the db

        $userIdQuery = "SELECT * FROM users WHERE userEmail = ?;";
        if ($userStmt = $connect->prepare($userIdQuery)) {
            $userStmt->bindParam(1, $userEmail);
            $userEmail = trim($_POST["email"]);

            if ($userStmt->execute()) {
                $userArray = $userStmt->fetchAll();
                $thisID = $userArray[0]["userId"];
                $userName = $userArray[0]["userName"];
            } else {
                echo "Fuck! We fucked up somewhere";
            }
        }

        $passWordQuery = "SELECT * FROM userPasswords WHERE userID = ?";
        if ($passWordStmt = $connect->prepare($passWordQuery)) {
            $passWordStmt->bindParam(1, $usersID);
            $usersID = $thisID;

            if ($passWordStmt->execute()) {
                $hashedPassword = $passWordStmt->fetch()["userPassword"];
            } else {
                echo "Oh shit, we couldn't find that shit";
            }
        }

        if (password_verify($password, $hashedPassword)) {
            echo "That shit matches";
            session_start();
            $_SESSION["userName"] = $userName;
            $_SESSION["userId"] = $thisID;
            $_SESSION["userEmail"] = $userEmail;
            header("Location: ../home.php");
        } else {
            echo "You entered it wrong";
        }
    }

};
?>
<link rel="stylesheet" type="text/css" href="../../dist/css/login-page.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="../../dist/scripts/recover-password.js"></script>

<article>
    <section class="initial-login">
        <h1>Welcome to albumShare!</h1>
        <?php include "../includes/loginForm.php" ?>
        <p>New to ablumShare? <a href="createAccount.php?new_account=true" target="_self"> create your account here!</a></p>
        <p class="lost-pw">Lost your password?</p>
        <div class="lost-pw-form">
            <label for="recovery-email">Email for Account Recovery</label>
            <input type="text" name="recovery-email">
            <button class="recover-submit">Recover my Password!</button>
        </div>
    </section>
</article>
