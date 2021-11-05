<?php
// This page displays the form for adding a chore to the household

session_start();
require "security.php";
loggedIn();     // Checks the user is logged in, otherwise they will be redirected to the login page.

$hid = $_GET['hid'];

require "database.php";
$id = $_SESSION['ID'];
$db = new Database();
$userDetails = $db->querySingle("SELECT * FROM USERS WHERE ID = '$id';");

if ($userDetails['HID'] != $hid) {      // Makes sure they have permission to access the resource (so they can't change the url to add chores for other households)
    header('location:login.php');   
    exit();  
}

include "header.php";                   // Includes the header at the top as usual
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <title>Add Chore</title>
    <script src='js/jquery-3.5.1.min.js'></script>
    <script src='js/addChore.js'></script>
</head>
<body>
<br>
<br>
<h1 style="color: #e63939;">Add a New Chore</h1>
<br>

<!-- Form for adding a chore -->
<form id="form" method="post" action="addChoreDB.php" accept-charset="utf-8">

    <label style="color: #1bc1c7;" for="title">Chore Title</label>
    <br>
    <input name="title" type="text" value="" id="title">
    <div id="title_errors" style="color:red;">
    </div>
    <br>

    <label for="desc" style="font-size: 23px; color: #d4852a;">Chore Description</label>
    <br>
    <textarea cols="33" rows="3" name="desc" id="desc"></textarea>
    <div id="desc_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #1bc1c7;">Chore Difficulty</label>
    <br>
    <select name="difficulty">
        <option>Easy</option>
        <option>Medium</option>
        <option>Hard</option>
    </select>
    <br>
    <br>
    <input type="hidden" name="hid" value="<?php echo $hid;?>" id="hid">

    <label style="color: #d4852a;" for="frequency">Chore Frequency/Deadline</label>
    <br>
    <input name="frequency" type="text" value="" id="frequency">
    <div id="frequency_errors" style="color:red;">
    </div>
    <br>

    <label style="color: #1bc1c7;">Is it an active or upcoming chore?</label>
    <br>
    <select name="status">
        <option>Active</option>
        <option>Upcoming</option>
    </select>
    <br>
    <br>

    <label style="color: #d4852a;">Send email notifcation to user?</label>
    <br>
    <select name="send">
        <option>No, do not send email</option>
        <option>Yes, send email</option>
    </select>
    <br>
    <br>
    <br>

    <!-- Submit button -->
    <input class="createAccBtn" type="submit" value="Create Chore"> 
    <br>
    <br>
    <br>

    <!-- Back button -->
    <span onclick="window.location.replace('chores.php?hid=<? echo $hid ?>')" class="back">⟵</span> 
    <span class="hide">Back</span>
    <br>
    <br>
    <br>
    <br>
</form>

</body>
</html>