<?php
include 'header.php';
?>
<h1>Hello</h1>
<form action="words.php" method="POST">
    <table cellpadding="12">
        <tbody>
            <tr>
                <td>Your Number?</td>
                <td>
                    <input name="userID" type="text">
                </td>
            </tr>
            <tr>
                <td>A Word</td>
                <td>
                    <input name="word" type="text">
                </td>
            </tr>
            <tr>
                <td>More Words Word</td>
                <td>
                    <textarea name="moreWords"></textarea>
                </td>
            </tr>
            <tr>
                <td>Do you like words?</td>
                <td>
                    <input type="checkbox" name="yesNo">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Send your words">
                </td>
            </tr>
        </tbody>
    </table>
</form>
