<?php
require '../../code/pdo.php';
$connect = pdoConnect::connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "GET" ) {

    $recoveryHash = (!empty($_GET['recovery'])) ? $_GET['recovery'] : '';
    $email = (!empty($_GET['email'])) ? $_GET['email'] : '';

    echo $recoveryHash . " - " . $email;

//    // If either of the vars are empty strings, this page was reached by accident.
//    if ($email === '' || $recoveryHash === '' ) {
//        echo '<h2>Sorry, you have reached this page unintentionally</h2>';
//
//        // Pulled this code from basic login, shuld be refactored.
//        include '../../code/includes/redirectToHome.php';
//    }
//    // Get the id for the user from the users db using the email.
//
//    $getRecoverHashQuery = 'FROM users SELECT userId WHERE userEmail = ?';
//    $getRecoverHashStmt = $connect->prepare($getRecoverHashQuery);
//    $getRecoverHashStmt->bindParam(1, $userEmail);
//    $userEmail = $email;
//    $emailForId = $getRecoverHashStmt->fetchAll(PDO::FETCH_ASSOC);
//    $id = $emailForId[0]['userId'];

    // Check that hash against that user's email's recoveryHash

    // if they match, allow them to get to this page / form

    // else, show an error message and redirect them home

    // from the form they should reset their password

    // once submitted, send them back to the initial login to log in.
}
?>

<link rel="stylesheet" type="text/css" href="../../dist/css/homepage.css">
<form>
    <label for="password">Password</label>
    <input type="password" name="password">
    <label for='rPassword'>Repeat Password</label><input type='password' name='rPassword'>
    <input type='submit' value='Create account'>
</form>
