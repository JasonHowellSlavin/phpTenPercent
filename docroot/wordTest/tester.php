<?php
function getFromDataBase () {
    $dsn = 'mysql:dbname=myWords;host=mysql';
    $user = 'developer';
    $password = 'developer';

    $dbh = new PDO($dsn, $user, $password);

    $word =$dbh->query('SELECT personWord FROM webWords WHERE personID = 1;');
    $ourWord = $word->fetch();

    echo json_encode($ourWord);

//    return $ourWordNow;
}

getFromDataBase();