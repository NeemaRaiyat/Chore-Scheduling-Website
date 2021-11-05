<?php
require "choresDisplayer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <script src='js/jquery-3.5.1.min.js'></script>
    <title>My Chores</title>
    <style>
        /* Pointer is changed if user hovers over an active chore */
        tr[data-href] {         
            cursor: pointer;
        }
        tr[upc] {         
            cursor: pointer;
        }
    </style>
</head>
<body>
    
<br>
<h1 style="font-size: 60px; color: rgb(234, 152, 236);">
    <?php 
        echo "Welcome ".hsc($username)." !"; 
    ?>
</h1>
<br>

<!-- Add button to add a new chore -->
<span onclick="addChore()" class="addBtn" id="addBtn">+</span>  
<span class="hide">Add New Chore</span>
<br>

<!-- ACTIVE CHORES -->
<h1 style="color: #d4852a;">Active Chores</h1>
<table class="Table" id="activeTable">
        <thead>
            <tr>
                <th>Chore</th>
                <th>Description</th>
                <th>Frequency/Deadline</th>
                <th>Difficulty</th>
                <th>Created On</th>
            </tr>
        </thead> 

        <tbody id="active">
            <?php
                echo $activeChores;
            ?>
        </tbody>
</table> 

<!-- UPCOMING CHORES -->
<h1 style="color: #e63939;">Upcoming Chores</h1>
<table class="Table" id="upcomingTable">
        <thead>
            <tr>
                <th>Chore</th>
                <th>Description</th>
                <th>Frequency/Deadline</th>
                <th>Difficulty</th>
                <th>Created On</th>
            </tr>
        </thead> 

        <tbody>
            <?php
                echo $upcomingChores;
            ?>
        </tbody>
</table> 

<!-- COMPLETE CHORES -->
<h1 style="color: #1bc1c7;">Completed Chores</h1>
<table class="Table" id="completedTable">
        <thead>
            <tr>
                <th>Chore</th>
                <th>Description</th>
                <th>Frequency/Deadline</th>
                <th>Difficulty</th>
                <th>Created On</th>
            </tr>
        </thead> 

        <tbody id="complete">
            <?php
                echo $completeChores;
            ?>
        </tbody>
</table> 

<!-- HOUSEMATE'S CHORES -->
<h1 style="color: #009879;">Your Housemate's Chores</h1>
<table class="Table" id="housematesTable">
        <thead>
            <tr>
                <th>Chore</th>
                <th>Frequency/Deadline</th>
                <th>Created On</th>
                <th>Difficulty</th>
                <th>Belongs to</th>
                <th>Status</th>
            </tr>
        </thead> 

        <tbody>
            <?php
                echo $housematesChores;
            ?>
        </tbody>
</table> 

<script>
    document.addEventListener("DOMContentLoaded", () => {

        // Clicking an active chore will remove the chore from the 'active chores' table and add it to the 'complete chores' table
        // This will only happen if completeChore.php successfully manages to update the chore in the database
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row => {
            row.addEventListener("click", () => {
                $.get("completeChore.php?cid=" + row.getAttribute("id") , function (data) {
                    var cid = row.getAttribute("id");
                    $('#'+ cid).hide(550);
                    $("<tr data-href='chore.php?cid="+cid+"'>"+$('#'+ cid).html()+"</tr>").hide().appendTo('#complete').fadeIn(900);
                })
            })
        })

        // Clicking an upcoming chore will remove the chore from the 'upcoming chores' table and add it to the 'active chores' table
        // This will only happen if activateChore.php successfully manages to update the chore in the database
        const rows2 = document.querySelectorAll("tr[upc]");

        rows2.forEach(row => {
            row.addEventListener("click", () => {
                $.get("activateChore.php?cid=" + row.getAttribute("id") , function (data) {
                    var cid = row.getAttribute("id");
                    $('#'+ cid).hide(550);
                    $("<tr data-href='chore.php?cid="+cid+"' id='"+cid+"'>"+$('#'+ cid).html()+"</tr>").hide().appendTo('#active').fadeIn(900);

                })
            })
        })
    });
    // This redirects the user to the add chore page
    function addChore() {
        window.location.replace('addChore.php?hid=<?php echo $hid; ?>');
    }
</script>

<br>
<!-- Back button -->
<span onclick="window.location.replace('login.php')" class="back">⟵</span> 
<span class="hide">Back</span>
<br>
<br>
<br>
<br>

</body>
</html>