<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 2/7/18
 * Time: 5:17 PM
 */
require '../code/pdo.php';
$connect = pdoConnect::connectToDB();
session_start();

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";

public function ($postUserEmail, $postRecArtist, $postRecAlbum, $numRecs) {

    get

    $mesage = "
    <html>
    <head>
        <title>Your Reccomendations from $friendId</title>
    </head>
    <body>
        <table style='border-spacing:20px;'> 
            <tbody>
                <tr>
                   <td> Hey $name
                   </td>
                </tr>
                <tr>
                    <td>
                    You just got some new recs! 
                    </td>
                </tr>
                <tr>
                     <td>
                     Here they are:
                        <table>
                            <tr>
                               <td>
                               Artist:
                               </td>
                               <td>
                               Album:
                               </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </td>
                </tr>
            </tbody>
    </body>";
}




