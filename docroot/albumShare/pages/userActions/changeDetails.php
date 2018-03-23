<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();
session_start();

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";

$newUserName = $newUserEmail = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    if (isset($_POST['new-user-name']) && trim($_POST['new-user-name'] !== '')) {
        if (trim($_POST['new-user-name']) === trim($_POST['confirm-new-user-name'])) {
            $newUserName = trim($_POST['new-user-name']);
        } else {
            echo 'Seems like your user names do not match';
        }
    } else {
        echo 'new user name is empty';
    }

    if (isset($_POST['new-email']) && trim($_POST['new-email'] !== '')) {
        if (trim($_POST['new-email']) === trim($_POST['confirm-new-email'])) {
            $newUserEmail = trim($_POST['new-email']);
        } else {
            echo 'Looks like your emails do not match';
        }
    } else {
        echo 'new email is empty';
    }

    $updateDetailsQuery = "UPDATE users SET userName = ?, userEmail = ? WHERE userId = ?;";
    $updateDetailsStmt = $connect->prepare($updateDetailsQuery);
    $updateDetailsStmt->bindParam(1, $newName);
    $updateDetailsStmt->bindParam(2, $newEmail);
    $updateDetailsStmt->bindParam(3, $userId);
    $newName = $newUserName;
    $newEmail = $newUserEmail;
    $userId = $id;

    if ($updateDetailsStmt->execute()) {
        echo "<h2>Your details have been updated</h2>";
        include '../../code/includes/redirectToHome.php';
    } else {
        echo "Holy shit, something went wrong";
    }
}

?>

<link rel="stylesheet" type="text/css" href="../../dist/css/login-page.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

<article>
    <section class="change-details-modal" >
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <p>Current User Name: <?php echo $name ?></p>
                <label for="new-user-name">New User Name</label>
                <input type="text" name="new-user-name">
                <label for="confirm-new-user-name">Confirm New User Name</label>
                <input type="text" name="confirm-new-user-name">
            </div>
            <div>
                <p>Current Email: <?php echo $email ?></p>
                <label for="new-email">New E-mail</label>
                <input type="text" name="new-email">
                <label for="confirm-new-email">Confirm New E-mail</label>
                <input type="text" name="confirm-new-email">
            </div>
            <input type="submit" value="Change Details">
        </form>
    </section>
</article>
