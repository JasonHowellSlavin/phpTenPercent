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

<article>
    <h2>Your Current Details</h2>
    <h3>User Name: <?php echo $name ?></h3>
    <h3>Email: <?php echo $email ?> </h3>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="current-password">New User Name</label>
        <input type="password" name="user-name">
        <label for="new-password">New E-mail</label>
        <input type="password" name="new-email">
        <input type="submit" value="Change Details">
    </form>
</article>