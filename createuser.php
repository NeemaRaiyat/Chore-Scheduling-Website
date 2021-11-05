<?php
// This file creates a new user
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

require "database.php";
$db = new Database();
$stmt = $db->prepare("INSERT INTO USERS VALUES (NULL, 0, :email, :username, :hashed_password, 0)");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':hashed_password', $hashed_password, SQLITE3_TEXT);
$stmt->execute();

// User is automatically logged in and therefore session is started and set to the user's ID
session_start();
$stmt = $db->prepare("SELECT * FROM USERS WHERE NAME=:username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$users = $stmt->execute();
$user = $users->fetchArray();
$_SESSION['ID'] = $user['ID'];

// This will redirect them to either join an existing household or create a new one
$status = $_POST['status'];
if ($status == "Yes, I'm joining an existing chore group!") {
    header('location:joinHouse.php');
}
else {
    header('location:createHouse.php');
}

?>