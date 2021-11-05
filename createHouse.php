<?php
// This page lets the user create a new household once they create an account
session_start();
require "security.php";
loggedIn();         // Checks the user is logged in, otherwise they will be redirected back to login page
include "header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Create Chore Group</title>
    <script src='js/jquery-3.5.1.min.js'></script>
    <script src='js/createGroup.js'></script>
</head>
<body>
<br>
<br>
<h1 style="color: #d4852a;">Create Chore Group</h1>
<br>

<!-- FORM FOR CREATING NEW HOUSEHOLD -->
<form id="form" style="padding: 10px;" method="post" action="createHouseDB.php" accept-charset="utf-8">

    <label for="name" style="color: #e63939;">Choose a Group name</label>
    <br>
    <input name="name" type="text" value="" id="name">
    <div id="name_errors" style="color:red;">
    </div>
    <br>

    <label for="password" style="color: #1bc1c7;">Choose a group password</label>
    <br>
    <input name="password" type="password" value="" id="password">
    <div id="pw_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #009879;" for="passwordConf">Confirm Password</label>
    <br>
    <input name="passwordConf" type="password" value="" id="passwordConf">
    <div id="pwc_errors" style="color:red;">
    </div>
    <br>

    <input class="loginBtn" type="submit" value="Create New Group!">
</form>

</body>
</html>
