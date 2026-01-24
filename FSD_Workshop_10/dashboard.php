<?php

require 'db.php';
require 'session.php';

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location:login.php");
    exit;
}

$user_email = '';
$is_logged_in=false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // $sql = "SELECT email FROM users WHERE id = '$user_id'";
    // $stmt = $pdo->query($sql);

    $sql=$pdo->prepare("SELECT email FROM users WHERE id =?");
    $sql->execute([$user_id]);
    $user = $sql->fetch();
    
    if ($user) {
        $user_email = $user['email'];
        $is_logged_in=true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to my site</h1>
<?php if ($is_logged_in): ?>
    <p>Logged In User : <?php echo htmlspecialchars($user_email,ENT_QUOTES,'UTF-8'); ?></p>
    <form method='POST'>
    <button type='submit' name="logout">Logout</button>
</form>
<?php else: ?>
<a href="login.php">
    <button>Login</button>
</a>
<?php endif; ?>

</body>
</html>
