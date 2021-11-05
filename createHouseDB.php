<?php
// This file adds a new household to the database
session_start();
require "security.php";
loggedIn();         // Makes sure the user is logged in as per usual (otherwise redirected back to login page)
require "database.php";

$name = $_POST['name'];
$password = $_POST['password'];
$id = $_SESSION['ID'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$db = new Database();
$stmt = $db->prepare("INSERT INTO HOUSES VALUES (NULL, :name, :hashed_password)");  // Add new house group
$stmt->bindValue(':name', $name, SQLITE3_TEXT);
$stmt->bindValue(':hashed_password', $hashed_password, SQLITE3_TEXT);
$stmt->execute();

$stmt = $db->prepare("SELECT * FROM HOUSES WHERE NAME=:name");
$stmt->bindValue(':name', $name, SQLITE3_TEXT);
$houses = $stmt->execute();
$house = $houses->fetchArray();
$hid = $house['HID'];

$db->exec("UPDATE USERS SET HID = '$hid' WHERE ID = '$id'");    // Updates the house ID of specific user
// Protection against SQL injection is not necessary as both $hid and $id where made using a primary key and were only obtained via previous queries of the database

header('location:chores.php?hid='.$hid);

?>