<?php 
// This file contains various functions to ensure one users activity cannot malicously harm anothers
function loggedIn() {
    if (!isset($_SESSION['ID'])) {          // Must have logged in (either via the login page or the signup) otherwise redirected back to login page
        header('location:login.php');
        exit();
    }
}
function hsc($string) {                     // Prevent XSS (Cross site scripting)
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}
function cleanSession() {                   // This completely removes the user's current session
    session_start();  
    session_destroy();
    session_unset();
}

?>