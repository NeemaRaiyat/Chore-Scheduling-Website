<?php
// This will log the user in, assuming the details are correct otherwise they will be redirected back to the login page
session_start();
require "database.php";

$email = $_POST['email'];
$password = $_POST['password'];

$db = new Database();
$stmt = $db->prepare("SELECT * FROM USERS WHERE EMAIL=:email");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$users = $stmt->execute();
$user = $users->fetchArray();

header('location:login.php');       // If user doesn't exist in db
if (password_verify($password, $user['PASSWORD'])) {
    $_SESSION['ID'] = $user['ID'];
    header('location:chores.php?hid='.$user['HID']);
}
?>