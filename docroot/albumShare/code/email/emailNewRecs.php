<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 2/7/18
 * Time: 5:17 PM
 */
require '../pdo.php';
$connect = pdoConnect::connectToDB();
session_start();

require '../../../vendor/autoload.php';
use Mailgun\Mailgun;
$mailgun = new Mailgun('api_key', new \Http\Adapter\Guzzle6\Client());

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";



# Instantiate the client.
$mgClient = new Mailgun('78901d2ba85f304101bd27611542885a');
$domain = "absh-www.jhslavin.com";

echo gettype($mgClient);

# Make the call to the client.
try {
    $result = $mgClient->sendMessage($domain, array(
        'from'    => 'Excited User <mailgun@absh-www.jhslavin.com>',
        'to'      => 'Baz <slavin.jhs@gmail.com>',
        'subject' => 'Hello',
        'text'    => 'Testing some Mailgun awesomness!'
    ));
} catch (Exception $e){
  echo "Humphrey";
};


?>

<h1>Yo</h1>
<?php
//public function ($postUserEmail, $postRecArtist, $postRecAlbum, $numRecs) {
//
//    get
//
//    $mesage = "
//    <html>
//    <head>
//        <title>Your Reccomendations from $friendId</title>
//    </head>
//    <body>
//        <table style='border-spacing:20px;'>
//            <tbody>
//                <tr>
//                   <td> Hey $name
//                   </td>
//                </tr>
//                <tr>
//                    <td>
//                    You just got some new recs!
//                    </td>
//                </tr>
//                <tr>
//                     <td>
//                     Here they are:
//                        <table>
//                            <tr>
//                               <td>
//                               Artist:
//                               </td>
//                               <td>
//                               Album:
//                               </td>
//                            </tr>
//
//
//
//
//
//
//
//                        </table>
//                    </td>
//                </tr>
//            </tbody>
//    </body>";
//}




