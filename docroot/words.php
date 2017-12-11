<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 11/29/17
 * Time: 9:56 AM
 */

/**
 *
 *  Three ways that the browser sends data to the server
 *
 *  GET = $_GET Associative Array
 *  Post = $_POST
 *  Cookie = $_Cookie
 *
 *  All these feed into $_Request
 *
 *  Brandon says to use prepared statements
 *
 */

$yesNo = false;

if (isset($_POST['yesNo'])) {
    $yesNo = true;
}

if ($_POST['word'] == '' ) {
    echo "No word today?";
    exit;
} else {
    $word = addslashes($_POST['word']);
    $words = addslashes($_POST['moreWords']);
    $checkbox = (isset($_POST['yesNo'])) ? 1: 0;
    $id = addslashes($_POST['userID']);
};



function addWordsToDB ($col1, $col2, $col3, $col4) {
    $dsn = 'mysql:dbname=myWords;host=mysql';
    $user = 'developer';
    $password = 'developer';
    $myVal =  'null' . ', ' . $col1 . ', "' . $col2 . '", "' . $col3 . '", ' . $col4 ;
    $insertQuery = 'INSERT INTO webWords VALUES ' . '(' . $myVal . ');';


    try {
        $dbh = new PDO($dsn, $user, $password);

        $dbh->query($insertQuery);

        foreach( $dbh->query('SELECT * FROM webWords;') as $row) {
            printf("<tr><td> %s </td><td> %s </td><td> %s </td><td> %s </td></tr>",
                htmlentities($row["personID"]),
                htmlentities($row["personWord"]),
                htmlentities($row["personMoreWords"]),
                htmlentities($row["personLikeWords"]));

//            print $row['primaryID'] . "\t";
//            print $row['personID'] . "\t";
//            print $row['personWord'] . "\t";
//            print $row['personMoreWords'] . "\t";
//            print $row['personLikeWords'] . "\n";
        }

    } catch (PDOException $e) {
        echo 'Connection failed: ' . "\n" . $e->getMessage();
    }

    exit();
}

?>
<table>
    <tbody>
        <tr>
            <td>Submitter's Number</td>
            <td>Submitter's Words</td>
            <td>Submitter's More Words</td>
            <td>Did they like words?</td>
        </tr>
        <?php
                addWordsToDB($id, $word, $words, $checkbox);
        ?>
    </tbody>
</table>


