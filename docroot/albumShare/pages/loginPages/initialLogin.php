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



        // if the user is in the db, we pull up the id associated with that user

        // we then hash the password, and check to see if the hashed password for that user fits the password input

        //if it does, we set the session object with the id of the user

        // we then redirect to the welcome page.
    }

};
?>
<link rel="stylesheet" type="text/css" href="../../dist/css/form-pages.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

<article>
    <section>
        <h1>Welcome to albumShare!</h1>
        <?php include "../includes/loginForm.php" ?>
        <p>New to ablumShare? <a href="createAccount.php?new_account=true" target="_self"> create your account here!</a></p>
    </section>
</article>
