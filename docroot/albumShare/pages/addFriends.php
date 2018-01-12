<?php

$albumShareDB = 'mysql:dbname=albumShare;host=mysql';
$dbUser = 'developer';
$dbPassword = 'developer';

$connect = new PDO($albumShareDB, $dbUser, $dbPassword);


$friend = $_POST["friend"];
$number = $_POST["number-of-recs"];

$stmt = $connect->prepare("SELECT CONCAT(userNameFirst, ' ', userNameLast)from users where userId =" . $friend . ";");
$stmt->execute();
$friendName = $stmt->fetch()[0];

echo "<h1> HERE </h1>";
echo "<h2>" . $friend . " " . $number . $friendName . "</h2>";

?>

<article>
    <section>
        <h1>Your Recommendations for <?php echo $friendName ?></h1>
        <form name="recForm" action="addRecForm.php">
            <?php
            for ($i = 0; $i < $number; $i++) {
                include "./includes/addRecForm.php";
            }
            ?>
            <input type="submit" value="Submit your rec(s)!">
        </form>

    </section>
</article>


