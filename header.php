<!-- This file is simply the header used on all pages -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <title>The Chorinator 3000</title>
</head>
<body>
    <div class="header">
        <div class="inner_header">
            <div onclick="location.replace('login.php')" class="logo_container">
                <h1>THE <span>CHORINATOR 3000</span></h1>
                <div>
                <img src="css/icon.png" alt="The Chorinator Icon" style="width: 60px; height: 60px; padding: 10px;">
                </div>
            </div>

            <ul class="navigation">
                <a onclick="window.history.back();" class="home"><li>Home</li></a>
                <a href="signup.php" class="createAcc"><li>Create Account</li></a>
                <a href="login.php" class="login"><li>Logout</li></a>
            </ul>
        </div>
    </div>
</body>
</html>