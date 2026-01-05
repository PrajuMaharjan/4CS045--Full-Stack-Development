<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? 'light';

if ($theme === 'dark') {
    $bgColor = "#000";
    $textColor = "#fff";
} else {
    $bgColor = "#fff";
    $textColor = "#000";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
    body {
        background-color: <?= $bgColor ?>;
        color: <?= $textColor ?>;
        font-family: Arial, sans-serif;
    }
    a {
        color: <?= $textColor ?>;
        margin-right: 15px;
    }
</style>
</head>
<body>

<h1>Welcome to Dashboard</h1>

<nav>
    <a href="dashboard.php">Home</a>
    <a href="preference.php">Change Theme</a>
</nav>

<br><br>

<form method="post">
    <button type="submit" name="logout">Logout</button>
</form>

</body>
</html>
