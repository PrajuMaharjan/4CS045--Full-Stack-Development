<?php
session_start();
	require 'db.php';
try{
	if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["check_student"])){

		$student_id=$_POST['id'];
		$name=$_POST["name"];
		$password=$_POST["password"];


		$sql="SELECT * FROM students WHERE student_id=?";
		$stmt=$pdo->prepare($sql);
		$stmt->execute([$student_id]);

		$student=$stmt->fetch();
		if($student){
			$hashed_password=$student['password_hash'];
			if(password_verify($password,$hashed_password)){
				$_SESSION['logged_in'] = true;
				$_SESSION['student_id']=$student_id;
				header("Location:dashboard.php");
				exit();
			}else{
				echo "Invalid password.";
			}

	}else{
	echo "No  student with that id.";
		}	
	}
}catch(PDOException $e){
	echo "Error";
	}

?>

<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=1.0">
<title>Student Login</title>	
</head>
<body>
<form method = "post">
	Student ID : <input type="text" id="student_id" name="id" required><br>
	Name : <input type="text" id="name" name="name" required><br>
	Password : <input type="password" id="password" name="password" required><br>
	<input type="submit" value="Login" id="submit-btn" name="check_student"><br>
</form>
</body>