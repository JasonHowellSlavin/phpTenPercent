<?php
session_start();
require '../code/pdo.php';
$connect = pdoConnect::connectToDB();

$friend = $_POST["friend"];
$number = $_POST["number-of-recs"];

$stmt = $connect->prepare("SELECT userName FROM users WHERE userId =" . $friend . ";");
$stmt->execute();
$friendName = $stmt->fetch()[0];
?>

<link rel="stylesheet" type="text/css" href="../dist/css/form-pages.css">

<article>
    <section>
        <h2>Your Recommendations for <?php echo $friendName ?></h2>
        <form class="recommendations-form" name="recForm" action="./responsePages/shareAlbumResponse.php" method="POST">
            <input type="hidden" name="number-of-recs" value="<?php echo $number ?>" />
            <input type="hidden" name="friendID" value="<?php echo $friend ?>">
            <div class="artist-album">
                <?php
                for ($i = 0; $i < $number; $i++) {
                    include "./includes/shareAlbumForm.php";
                }
                ?>
            </div>
            <div class="add-theme">
                <label for="theme"> Add a theme?</label>
                <input type="text" name="theme">
                <input type="submit" value="Submit your rec(s)!" />
            </div>
        </form>

    </section>
</article>


