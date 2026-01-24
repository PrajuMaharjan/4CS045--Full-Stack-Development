<?php

require 'db.php';

$message = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $error=false;

        if(strlen($password)==0){
            $passwordError="Password is empty";
            $error=true;
        }
        else if(strlen($password)<8){
            $passwordError="Password must be atleast 8 characters long.";
            $error=true;
        }

        if(!$error){
        $hashed_password=password_hash($password, PASSWORD_DEFAULT);

        $sql =$pdo->prepare("INSERT INTO users (email, password) VALUES (?,?)");

        $sql->execute([$email,$hashed_password]);

        $message = "User signed up successfully";
        header('refresh: 2; url=login.php');
    }
}

} catch (Exception $e) {
    $message = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>
    <?php if (!empty($passwordError)):?>
        <div style='color:red;'>
    <?php echo $passwordError; ?>
    <?php endif; ?>
    <button type="submit">Signup</button>
</form>

<br>
<a href="login.php">Go to Login</a>

</body>
</html>
