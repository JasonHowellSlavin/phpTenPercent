<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 11/30/17
 * Time: 9:15 AM
 */

/**
 *  normally, the host would be the name of the IP address where the server hosts the SQL database. In many set ups using
 *  a lamp stack, the SQL server is run on the apache server, and so linking via the IP is fine. However, docker runs each
 *  container seperately, and so we need to let it know the name of the container running the SQL server, in this case mysql.
 */

$dsn = 'mysql:dbname=myWords;host=127.0.0.1';
$user = 'developer';
$password = 'developer';
$myVal = 'null, "grape", "5", "Hi there", "8", true ';
$insertQuery = 'INSERT INTO words VALUES ' . '(' . $myVal . ')';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo 'Success' . "\n";
    foreach( $dbh->query('SELECT * FROM webWords') as $row) {
        print $row['primaryID'] . "\t";
        print $row['personID'] . "\t";
        print $row['personWord'] . "\t";
        print $row['personMoreWords'] . "\t";
        print $row['personLikeWords'] . "\n";
    }
//    $dbh->query($insertQuery);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

exit();

/**
 * Apparently there are stored precedures in SQL, that can be called via a query or prepaired statement. For example, if
 * wanted to return all words that had the letter R in them, i could put the procedure in mySQL with the following below:
 *
 * USE 'myWords';
 * CREATE FUNCTION 'return_letter' (letter)
 * RETURNS INTEGER
 * BEGIN
 * return (select count(*) from books where personWord regexp 'letter';
 * END
 *
 *  $stmt = $db->prepare("return_letter(?)");
 *  $stmt->execute(array('r'));
 *  printf("No. of words with r = %d\n", $stmt->fetchColumn());
 *
 *
 */