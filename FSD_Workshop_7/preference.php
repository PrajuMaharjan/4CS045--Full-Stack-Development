<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $theme = $_POST['theme'];
    setcookie('theme', $theme, time() + 86400 * 30);
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Theme Preference</title>
</head>
<body>
<h2>Select Theme</h2>
<form method="post">
    <input type="radio" name="theme" value="light" checked> Light Mode<br>
    <input type="radio" name="theme" value="dark"> Dark Mode<br><br>
    <button type="submit">Save Preference</button>
</form>

</body>
</html>
