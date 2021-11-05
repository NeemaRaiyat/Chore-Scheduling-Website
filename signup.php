<?php
// This file is the sign up form
require "security.php";
cleanSession();     // Everytime the user goes to the sign up page, the users session is completely deleted
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Sign Up</title>
    <script src='js/jquery-3.5.1.min.js'></script>
    <script src='js/signup.js'></script>
</head>
<body>
<br>
<br>
<h1 style="color: #e63939;">Create an Account</h1>
<br>

<!-- SIGN UP FORM -->
<form id="form" method="post" action="createuser.php" accept-charset="utf-8">

    <label style="color: #1bc1c7;" for="email">Please enter your email</label>
    <br>
    <input name="email" type="text" value="" id="email">
    <div id="email_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #d4852a;" for="username">Please select a username</label>
    <br>
    <input name="username" type="text" value="" id="username">
    <div id="un_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #1bc1c7;" for="password">Please select a password</label>
    <br>
    <input name="password" type="password" value="" id="password">
    <div id="pw_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #d4852a;" for="passwordConf">Confirm Password</label>
    <br>
    <input name="passwordConf" type="password" value="" id="passwordConf">
    <div id="pwc_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #1bc1c7;">Are you joining an existing house?</label><br>
    <select name="status">
        <option>Yes, I'm joining an existing chore group!</option>
        <option>No, I'm creating a new one!</option>
    </select>
    <br>
    <br>
    <br>

    <input class="createAccBtn" type="submit" value="Create Account">

</form>

</body>
</html>