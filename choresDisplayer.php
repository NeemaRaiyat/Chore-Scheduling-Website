<?php
// This file will display all the active, upcoming, complete and other chores for a particular user and their household
session_start();
require "security.php";
loggedIn();     // Makes sure the user is logged in, otherwise they will be redirected back to login page

$hid = $_GET['hid'];
$id = $_SESSION['ID'];

require "database.php";

// Gets the user's name
require "user.php";
$user = new User($id);
$username = $user->getName();

$db = new Database();
$userDetails = $db->querySingle("SELECT * FROM USERS WHERE ID = '$id';");
// SQL injection prevention not neccessary as session id cannot be changed

// Makes sure they have permission to access the resource (and not change url otherwise they could see the chores of other households)
if ($userDetails['HID'] != $hid) {
    header('location:login.php');   
    exit();  
}

$stmt = $db->prepare("SELECT * FROM CHORES WHERE HID = :hid");
$stmt->bindValue(':hid', $hid, SQLITE3_INTEGER);
$chores = $stmt->execute();

$activeChores = "";     // Status id = 0
$upcomingChores = "";   // Status id = 1
$completeChores = "";   // Status id = 2
$housematesChores = ""; 

while ( $chore = $chores->fetchArray() ) {

    $chorelink = "chore.php?cid=".$chore['CID'];
    $cid = $chore['CID'];

    switch ($chore['DIFFICULTY']) {     // Converts the difficulty to text for easier readability
        case 1: 
            $difficulty = "Easy";
            break;
        case 2:
            $difficulty = "Medium";
            break;
        case 3:
            $difficulty = "Hard";
            break;
    }
    
    if ($chore['ID'] == $id) {  // These will be the users chores

        if ($chore['STATUS'] == 0) {

            $activeChores.="<tr "."data-href='$chorelink'"." id='$cid'>";

            $activeChores.="<td>";
            $activeChores.= hsc($chore['TITLE']);  // Prevent XSS
            $activeChores.="</td>";

            $activeChores.="<td>";
            $activeChores.= hsc($chore['DESC']);
            $activeChores.="</td>";

            $activeChores.="<td>";
            $activeChores.= hsc($chore['FREQUENCY']);
            $activeChores.="</td>";

            $activeChores.="<td>";
            $activeChores.= hsc($difficulty);
            $activeChores.="</td>";

            $activeChores.="<td>";
            $activeChores.= hsc($chore['CREATED_AT']);
            $activeChores.="</td>";

            $activeChores.="</tr>";
        }
        else if ($chore['STATUS'] == 1) {

            $upcomingChores.="<tr upc='' id='$cid'>";

            $upcomingChores.="<td>";
            $upcomingChores.= hsc($chore['TITLE']);  // Prevent XSS
            $upcomingChores.="</td>";

            $upcomingChores.="<td>";
            $upcomingChores.= hsc($chore['DESC']);
            $upcomingChores.="</td>";

            $upcomingChores.="<td>";
            $upcomingChores.= hsc($chore['FREQUENCY']);
            $upcomingChores.="</td>";

            $upcomingChores.="<td>";
            $upcomingChores.= hsc($difficulty);
            $upcomingChores.="</td>";

            $upcomingChores.="<td>";
            $upcomingChores.= hsc($chore['CREATED_AT']);
            $upcomingChores.="</td>";

            $upcomingChores.="</tr>";
        }
        else {
            $completeChores.="<tr "."data-href='$chorelink'".">";

            $completeChores.="<td>";
            $completeChores.= hsc($chore['TITLE']);  // Prevent XSS
            $completeChores.="</td>";

            $completeChores.="<td>";
            $completeChores.= hsc($chore['DESC']);
            $completeChores.="</td>";
            
            $completeChores.="<td>";
            $completeChores.= hsc($chore['FREQUENCY']);
            $completeChores.="</td>";

            $completeChores.="<td>";
            $completeChores.= hsc($difficulty);
            $completeChores.="</td>";

            $completeChores.="<td>";
            $completeChores.= hsc($chore['CREATED_AT']);
            $completeChores.="</td>";

            $completeChores.="</tr>";
        }
    }
    else {  // These will be the chores belonging to the rest of the housemates

        $housematesChores.="<tr>";

        $housematesChores.="<td>";
        $housematesChores.= hsc($chore['TITLE']);  // Prevent XSS
        $housematesChores.="</td>";

        $housematesChores.="<td>";
        $housematesChores.= hsc($chore['FREQUENCY']);
        $housematesChores.="</td>";

        $housematesChores.="<td>";
        $housematesChores.= hsc($chore['CREATED_AT']);
        $housematesChores.="</td>";
        
        $housematesChores.="<td>";
        $housematesChores.= hsc($difficulty);
        $housematesChores.="</td>";

        $housematesChores.="<td>";
        $housematesChores.= hsc($chore['NAME']);
        $housematesChores.="</td>";

        $housematesChores.="<td>";
        switch ($chore['STATUS']) {     // Converting status into text for better readability
            case 0: 
                $housematesChores.= "Active";
                break;
            case 1:
                $housematesChores.= "Upcoming";
                break;
            case 2:
                $housematesChores.= "Complete";
                break;
        }
        $housematesChores.="</td>";

        $housematesChores.="</tr>";
    }
}
include "header.php";
?>