<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

$email = $password = "";
$emailErr = $passwordErr = "";
$thisID = "";

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

        $userIdQuery = "SELECT * FROM users WHERE userEmail = '" . trim($_POST["email"]) . "';";
        if ($userStmt = $connect->prepare($userIdQuery)) {
            $userStmt->bindParam(1, $userEmail);
            $userEmail = trim($_POST["email"]);

            if ($userStmt->execute()) {
                $thisID = $userStmt->fetch()["userId"];
                print_r($thisID);
            } else {
                echo "Fuck! We fucked up somewhere";
            }
        }

        $passWordStmt = $connect->prepare("SELECT * FROM userPasswords WHERE userID = ?");



        // if the user is in the db, we pull up the id associated with that user

        // we then hash the password, and check to see if the hashed password for that user fits the password input

        //if it does, we set the session object with the id of the user

        // we then redirect to the welcome page.
    }

};

?>
<article>
    <section>
        <h2>Welcome to albumShare!</h2>
        <?php include "../includes/loginForm.php" ?>
        <p>New to ablumShare? <a href="createAccount.php?new_account=true" target="_self"> create your account here!</a></p>
    </section>
</article>
