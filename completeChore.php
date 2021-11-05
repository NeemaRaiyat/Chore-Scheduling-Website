<?php 
// This will simply change a chores status to complete (AJAX is used by chores.php to do this without refreshing the page)
session_start();
require "security.php";
loggedIn();
$cid = $_GET['cid'];

require "database.php";
$db = new Database();
$db->exec("UPDATE CHORES SET STATUS = 2 WHERE CID = '$cid'");

?>
