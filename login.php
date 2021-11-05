<?php
// This file is simply the login page
require "security.php";
cleanSession();         // Everytime the user goes to the login page, the users session is completely deleted
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Login</title>
    <script src='js/jquery-3.5.1.min.js'></script>
    <script src='js/login.js'></script>
</head>
<body>
<br>
<br>
<h1 style="color: #1bc1c7;">Login</h1>
<br>

<!-- LOGIN FORM -->
<form id="form" style="padding: 10px;" method="post" action="loginuser.php" accept-charset="utf-8">

    <label for="email" style="color: #e63939;">Please enter your email</label>
    <br>
    <input name="email" type="text" value="" id="email"><br>
    <br>

    <label for="password" style="color: #d4852a;">Please enter your password</label>
    <br>
    <input name="password" type="password" value="" id="password">
    <br><br>
    <div id="pw_errors" style="color:red;">
    </div>
    <br>

    <input class="loginBtn" type="submit" value="Login">
</form>

</body>
</html>
