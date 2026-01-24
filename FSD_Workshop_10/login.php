<?php

require 'db.php';
require "session.php";

$error = '';
$user=null;
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token']=bin2hex(random_bytes(32));
}
try {
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        if(!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'],$_POST['csrf_token'])){
            die('Invalid request.');
        }else{

        $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
        $password = $_POST['password']??'';
        if (!$email || empty($password)) {
        $error = "Invalid email or password";
        }else{
        $sql = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $sql->execute([$email]);
        $user = $sql->fetch();
}
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid email or password";
            }
        }
    } 
}catch (Exception $e) {
    $error = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </p>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'],ENT_QUOTES,'UTF-8'); ?>">
    <label>Email:</label><br>
    <input type="text" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<br>
<a href="signup.php">Signup</a>
</body>
</html>