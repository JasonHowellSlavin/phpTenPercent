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
} else {
    $word = ($_POST['word']);
    $words = ($_POST['moreWords']);
    $checkbox = (isset($_POST['yesNo'])) ? 1: 0;
    $id = ($_POST['userID']);
};

function addWordsToDB () {
    $dsn = 'mysql:dbname=myWords;host=mysql';
    $user = 'developer';
    $password = 'developer';

    // Prepared statements below. There are three ways

    try {
        $dbh = new PDO($dsn, $user, $password);

        $stmtForInsert = $dbh->prepare("INSERT INTO webWords VALUES (null, ?, ?, ?, ?)");

        $stmtForInsert->bindParam(1, $pId);
        $stmtForInsert->bindParam(2, $pWord);
        $stmtForInsert->bindParam(3, $pWords);
        $stmtForInsert->bindParam(4, $pCheckbox);

        $pId = ($_POST['userID']);
        $pWord = ($_POST['word']);
        $pWords = ($_POST['moreWords']);
        $pCheckbox = (isset($_POST['yesNo'])) ? 1: 0;
        
        $stmtForDuplicateCheck = $dbh->prepare("SELECT * FROM webWords WHERE personID=?");

        $stmtForDuplicateCheck->bindParam(1, $submittedNumber, PDO::PARAM_STR);
        $submittedNumber = $_POST["userID"];

        $stmtForDuplicateCheck->execute();
        $rowCount = $stmtForDuplicateCheck->rowCount();

        if ( $rowCount == 0) {
            $stmtForInsert->execute();
        } else {
             echo "Sorry, that number has been taken";
        }
        
        /**
         * Here is a good example of a place where we might not want to use a prepared statement. Since there are no variables,
         * it might not be necessary.
         */
        foreach( $dbh->query('SELECT * FROM webWords;') as $row) {
            printf("<tr><td> %s </td><td> %s </td><td> %s </td><td> %s </td></tr>",
                htmlentities($row["personID"]),
                htmlentities($row["personWord"]),
                htmlentities($row["personMoreWords"]),
                htmlentities($row["personLikeWords"]));
        }

    } catch (PDOException $e) {
        echo 'Connection failed: ' . "\n" . $e->getMessage();
    }

    exit();
}


include 'header.php';
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


