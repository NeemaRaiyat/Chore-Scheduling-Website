<?php
// This page is the form that allows the user to join a current house
session_start();
require "security.php";
loggedIn();         // Checks the user is logged in otherwise they will be redirected back to the login page
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Join Chore Group</title>
    <script src='js/jquery-3.5.1.min.js'></script>
    <script src='js/joinGroup.js'></script>
</head>
<body>
<br>
<br>
<h1 style="color: #d4852a;">Join Chore Group</h1>
<br>

<form id="form" style="padding: 10px;" method="post" action="joinHouseDB.php" accept-charset="utf-8">

    <label for="name" style="color: #e63939;">Enter Group Name</label>
    <br>
    <input name="name" type="text" value="" id="name">
    <br>
    <br>

    <label for="password" style="color: #1bc1c7;">Enter Password</label>
    <br>
    <input name="password" type="password" value="" id="password">
    <br>
    <br>

    <div id="pw_errors" style="color:red;">
    </div>
    <br>
    <input class="loginBtn" type="submit" value="Join Group">
</form>

</body>
</html>
