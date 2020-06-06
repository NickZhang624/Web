<!-- <?php
//if(!isset($_SESSION["loggedin"])){
//    header("Location: /login_form");
//}
//?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <div class="w3-bar w3-dark-grey w3-margin-bottom">
        <a href="/admin/team_dashboard" class="w3-bar-item w3-button w3-black"
        data-user_id="<?php echo $_SESSION["id"]; ?>"
        id="team-admin-button">Team Admin Dashboard</a>
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button">Welcome <?php echo $_SESSION["username"]; ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card">
            <a href="/logout" class="w3-bar-item w3-button">logout</a>
            </div>
        </div>
    </div>

<h1>TEAM DASHBOARD AREA</h1>

<script src="https://www.w3school.com/lib/w3.js"></script>
<script src="../assets/js/admin.js"></script>
</body>

</html>