<?php

require '../code/pdoController.php';
require '../code/dateAndTime.php';
$connect = pdoController::connectToDB();
session_start();

//foreach($connect->query('SELECT * FROM userRecommendations WHERE recommendedTo = 1') as $row) {
//                printf("<tr><td> %s </td><td> %s </td><td> %s </td></tr>",
//                htmlentities($row["artist"]),
//                htmlentities($row["album"]),
//                htmlentities($row["recommendationDate"]),
//)};

$_SESSION['currentUser'] = 1;

?>
<link rel="stylesheet" type="text/css" href="../src/styles/homepage.css">

<article>
    <h1>AlbumShare</h1>
    <section class="recs-this-week">
     <h3>Albums reccomended to you this week!<?php echo "<p> Now" . time() . "</p><br>"; echo "<p> Today" . date('Y-m-d') . "</p><br>"; echo "<p>Today last week" . date('Y-m-d', strtotime("-1 week"))  . "</p><br>"?></h3>
        <table>
            <tbody>
            <tr>
                <td>Artist</td>
                <td>Album</td>
                <td>Date Reccomended</td>
            </tr>
            <?php
            $today = strtotime(date('Y-m-d'));
            $withinAWeek = strtotime(date('Y-m-d', strtotime("-1 week")));

            if ($today < $withinAWeek) { echo "today is less than a week ago";}
            if ( $today > $withinAWeek) { echo "today is greater than a week ago";}


            foreach( $connect->query("SELECT * FROM userRecommendations WHERE recommendedTo = 1;") as $row) {
                printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                    htmlentities($row["artist"]),
                    htmlentities($row["album"]),
                    htmlentities($row["recommendationDate"]));
            };
            ?>
            </tbody>
        </table>
    </section>
    <section class="add-friend">
        <h3>Add a friend</h3>
        <input type="text" name="friendSearch">
        <label for="friendSearch"> Search for and Add a Friend!</label>
    </section>
    <section class="share-album">
        <h3>Share an Album with Someone</h3>
        <form action="shareAlbum.php" method="POST">
            <p>Choose a friend</p>
            <select name="friend">
                <option value="default">------</option>
                <option value="deafult2">default</option>
                <?php
                foreach( $connect->query("SELECT * FROM users;") as $row) {
                    printf("<option value='%s'>%s %s</option>",
                        htmlentities($row["userId"]),
                        htmlentities($row["userNameFirst"]),
                        htmlentities($row["userNameLast"]));
                };
                ?>
            </select>
            <p>How many reccomendations?</p>
            <select name="number-of-recs">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <input type="submit" name="submit" value="Recommend Something!">
        </form>

    </section>
</article>
