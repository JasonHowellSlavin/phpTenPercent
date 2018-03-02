<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();
session_start();

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {


    return true;

}



?>

<div class="change-details-modal" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <p>Current User Name: <?php echo $name ?></p>
            <label for="new-user-name">New User Name</label>
            <input type="password" name="new-user-name">
            <label for="confirm-new-user-name">Confirm New User Name</label>
            <input type="password" name="confirm-new-user-name">
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
</div>