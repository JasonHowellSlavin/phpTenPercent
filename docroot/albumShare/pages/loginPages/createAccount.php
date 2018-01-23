<?php
require '../../code/pdo.php';

$connect = pdoConnect::connectToDB();
if(isset($_GET['new_account'])) {
    $newAccount = $_GET['new_account'];
}
$email = $password = $confirmPassword = $userName = "";
$emailErr = $passwordErr = $confirmPasswordErr = $userNameErr = "";
$idFromUserCreation = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    //This entire file needs error messaging and validation....

    //Validate the user Email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Please enter an email address";
    } else {
        // Prepare our query statment
        $emailQuery = "SELECT userId FROM users WHERE userEmail = ?";

        // If preparing the statement works, bind parameters to the PDO
        if ($stmt = $connect->prepare($emailQuery)) {
            $stmt->bindParam(1, $bindEmail);
            $bindEmail = trim($_POST["email"]);

            // Execute the statement, if the statement returns a row, we have found an already existing email. If not,
            // set the global var of username.
            if ($stmt->execute()) {
                if($stmt->rowCount() == 1) {
                    $emailErr = "This username is already taken.";
                    echo $emailErr;
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oh shit! Somethings not right";
            }
        }
        unset($stmt);
    }

    if (empty(trim($_POST["userName"]))) {
        $userNameErr = "Please enter a user name, ya?";
    } else {
        $userName = trim($_POST["userName"]);
    }

    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Please enter a password";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["rPassword"]))) {
        $confirmPasswordErr = "Please confirm your password";
    } elseif ($password !== trim($_POST["rPassword"])) {
        $confirmPasswordErr = "Passwords did not match, please enter again.";
    } else {
        $confirmPassword = trim($_POST["rPassword"]);
    }

    // Check if any the errors contain any characters. If they do not, the form was filled out correctly.
    if (empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($userNameErr)) {
        $newUserStmt = "INSERT INTO users VALUES (null, ?, ?);";
        $inputPasswordStmt = "INSERT INTO userPasswords VALUES (null, ?, ?, null);";

        if ($userStmt = $connect->prepare($newUserStmt)) {
            $userStmt->bindParam(1, $bindUserName);
            $userStmt->bindParam(2, $bindUserEmail);
            $bindUserName = trim($_POST["userName"]);
            $bindUserEmail = trim($_POST["email"]);

            if ($userStmt->execute()) {
                //This needs validation below, for sure. We do not know if what we are getting from the query is what we need for sure.
                $idFromUserCreation = $connect->query("SELECT * FROM users WHERE userEmail = '" . trim($_POST["email"]) . "';")->fetch()[0];
            } else {
                echo "user statement fail";
            }
        }

        unset($userStmt);

        if ($passwordStmt = $connect->prepare($inputPasswordStmt)) {
            $passwordStmt->bindParam(1, $bindUserID);
            $passwordStmt->bindParam(2, $bindUserPassword);
            $bindUserID = $idFromUserCreation;
            $bindUserPassword = password_hash($password, PASSWORD_DEFAULT);

            if ($passwordStmt->execute()) {
                header("location: ./initialLogin.php");
            } else {
                echo "Ooopsie";
            }
        }
        unset($passwordStmt);
    }
    unset($connect);
}

?>
<article>
    <section>
        <h2>Create your albumShare account!</h2>
        <?php include "../includes/loginForm.php" ?>
    </section>
</article>