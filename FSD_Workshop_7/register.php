<?php
	require 'db.php';
try{
	if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["add_student"])){
		$student_id=$_POST['id'];
		$name=$_POST["name"];
		$password=$_POST["password"];

		$hashed_password=password_hash($password,PASSWORD_BCRYPT);

		$sql="INSERT INTO students(student_id,full_name,password_hash) VALUES(?,?,?)";
		$stmt=$pdo->prepare($sql);
		if($stmt->execute([$student_id,$name,$hashed_password])){
			header("Location:login.php");
			exit();
		}

}}catch(PDOException $e){
	echo "Error : ".$e->getMessage();
	}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initialscale=1.0">
<title>Student Registration</title>	
</head>
<body>
<form method = "post">
	Student ID : <input type="text" id="student_id" name="id" required><br>
	Name : <input type="text" id="name" name="name" required><br>
	Password : <input type="password" id="password" name="password" required><br>
	<input type="submit" value="Register" id="submit-btn" name="add_student"><br>
</form>
	Already have an account?<a href="login.php"><button>Login</button></a>
</body>