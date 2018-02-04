<?php
session_start();
require '../code/pdo.php';
$connect = pdoConnect::connectToDB();

$friend = $_POST["friend"];
$number = $_POST["number-of-recs"];

$stmt = $connect->prepare("SELECT CONCAT(userNameFirst, ' ', userNameLast)from users where userId =" . $friend . ";");
$stmt->execute();
$friendName = $stmt->fetch()[0];
?>

<article>
    <section>
        <h1>Your Recommendations for <?php echo $friendName ?></h1>
        <form name="recForm" action="./responsePages/shareAlbumResponse.php" method="POST">
            <input type="hidden" name="number-of-recs" value="<?php echo $number ?>" />
            <input type="hidden" name="friendID" value="<?php echo $friend ?>"
            <?php
            for ($i = 0; $i < $number; $i++) {
                include "./includes/shareAlbumForm.php";
            }
            ?>
            <label for="theme"> Add a theme?</label>
            <input type="text" name="theme">
            <input type="submit" value="Submit your rec(s)!" />
        </form>

    </section>
</article>


