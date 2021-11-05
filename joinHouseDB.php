<?php
// This file links the user and the desired house they want to join (assuming details are corrected otherwise they will be redirected back to join house page)
session_start();
require "security.php";
loggedIn();             // Checks user is logged in otherwise they will be redirected back to login page
require "database.php";

$name = $_POST['name'];
$password = $_POST['password'];
$id = $_SESSION['ID'];

$db = new Database();
$stmt = $db->prepare("SELECT * FROM HOUSES WHERE NAME=:name");
$stmt->bindValue(':name', $name, SQLITE3_TEXT);
$houses = $stmt->execute();
$house = $houses->fetchArray();

header('location:joinHouse.php');       // IUser will be redirected back to join house page unless the details match and the header is updated below
if (password_verify($password, $house['PASSWORD'])) {
    $hid = $house['HID'];
    $db->exec("UPDATE USERS SET HID = '$hid' WHERE ID = '$id'");    //update HID of specific user
    // Protection against SQL injection is not necessary as both $hid and $id where made using a primary key and were only obtained via previous queries of the database
    header('location:chores.php?hid='.$hid);
}

?>