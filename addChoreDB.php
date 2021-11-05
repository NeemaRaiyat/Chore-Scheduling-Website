<?php
// This file adds a chore to the member of a particular household with the least workload

session_start();
require "security.php";
loggedIn();         // Makes sure the correct user is logged in, otherwise they will be redirected to the login page

$hid = $_POST['hid'];
$id = $_SESSION['ID'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$difficultyText = $_POST['difficulty'];
$freq = $_POST['frequency'];
$statusText = $_POST['status'];
$send = $_POST['send'];

// Converts the difficulty text to the corresponding values:   1: Easy , 2: Medium , 3: Hard
switch ($difficultyText) {
    case "Easy":
        $difficulty = 1;
        break;
    case "Medium":
        $difficulty = 2;
        break;
    case "Hard":
        $difficulty = 3;
        break;
}
// Converts the status text to the corresponding values:   0: Active , 1: Upcoming (2: Complete    but chores already completed will not be added)
switch ($statusText) {
    case "Active":
        $status = 0;
        break;
    case "Upcoming":
        $status = 1;
        break;
}

require "database.php";
$db = new Database();
$stmt = $db->prepare("SELECT * FROM USERS WHERE HID = :hid;");  
$stmt->bindValue(':hid', $hid, SQLITE3_INTEGER);
$users = $stmt->execute();

// This will find the user of the particular household with the lowest workload (sum of difficulties of each of their chores)
$min = 10000;
while ( $user = $users->fetchArray() ) {
    if ($user['WORKLOAD'] < $min) {
        $min = $user['WORKLOAD'];
        $laziestUser = $user;       // $laziestUser = user with the least workload
    }
}

$name = $laziestUser['NAME'];
$laziestUserID = $laziestUser['ID'];
$workload = $difficulty + $laziestUser['WORKLOAD'];
$created_at = date("F j, Y, g:i a");

// This will insert the chore into the database, binding each value to prevent SQL injection
$stmt = $db->prepare("INSERT INTO CHORES VALUES (NULL, :id, :hid, :title, :desc, :difficulty, :frequency, :created_at, :status, :name)");
$stmt->bindValue(':id', $laziestUserID, SQLITE3_INTEGER);
$stmt->bindValue(':hid', $hid, SQLITE3_INTEGER);
$stmt->bindValue(':title', $title, SQLITE3_TEXT);
$stmt->bindValue(':desc', $desc, SQLITE3_TEXT);
$stmt->bindValue(':difficulty', $difficulty, SQLITE3_INTEGER);
$stmt->bindValue(':frequency', $freq, SQLITE3_TEXT);
$stmt->bindValue(':created_at', $created_at, SQLITE3_TEXT);
$stmt->bindValue(':status', $status, SQLITE3_INTEGER);
$stmt->bindValue(':name', $name, SQLITE3_TEXT);
$stmt->execute();

// This will update the workload of the user with the least workload
$db->exec("UPDATE USERS SET WORKLOAD = '$workload' WHERE ID = '$laziestUserID'");

// If the user creating the chore desires, an email notification can be sent to whoever the chore is allocated to 
if ($send == "Yes, send email") {
    require "user.php";
    $sender = new User($id);
    $fromName = $sender->getName();
    $fromEmail = $sender->getEmail();
    $to = $laziestUser['EMAIL'];
    $subject = "NEW CHORE: ".hsc($title);
    $message = "<h1>NEW CHORE: ".hsc($title)."</h1><p>Description: ".hsc($desc)."</p><p>Difficulty: ".
                hsc($difficultyText)."</p><p>Frequency/Deadline: ".hsc($freq)."</p><p>Status: ".hsc($statusText)."</p><p>Created on: ".hsc($created_at)."</p>";

    $headers = "From: ".$fromName." <".$fromEmail.">\r\n";
    $headers .= "Reply-To: ".$fromEmail."\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
}

// Redirected back to main page of chores
header('location:chores.php?hid='.$hid);   

?>