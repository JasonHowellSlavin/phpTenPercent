<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "GET" ) {

    $recoveryHash = (!empty($_GET['recovery'])) ? $_GET['recovery'] : '';

    // If either of the vars are empty strings, this page was reached by accident.
    if ($recoveryHash === '' ) {
        echo '<h2>Sorry, you have reached this page unintentionally</h2>';

        include '../../code/includes/redirectToLogin.php';
    }

    // Ececute a statment to see if the hash produces a result, if it doesn't they might have landed here by hitting "back"
    $getRecoverHashQuery = "SELECT userId FROM userPasswords WHERE recoveryHash = ?";
    $getRecoverHashStmt = $connect->prepare($getRecoverHashQuery);
    $getRecoverHashStmt->bindParam(1, $hash);
    $hash = $recoveryHash;

    if (!$getRecoverHashStmt->execute()) {
        echo "<h2>Hrmm, this link isn't correct. Try resending yourself the reset password link.</h2>";
        include '../../code/includes/redirectToLogin.php';
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../dist/css/login-page.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../dist/css/homepage.css">

<article>
    <section>
        <form action="../responsePages/passwordReset.php" method="POST">
            <input type="hidden" name="hash" value="<?php echo $recoveryHash; ?>">
            <label for="password">Password</label>
            <input type="password" name="password">
            <label for='rPassword'>Repeat Password</label><input type='password' name='rPassword'>
            <input type='submit' value='Change password'>
        </form>
    </section>
</article>


