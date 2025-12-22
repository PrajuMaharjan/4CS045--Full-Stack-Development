<?php

function formatName($name) {
    $name =trim($name);
    $name =strtolower($name);     
    $parts =explode(" ", $name);

    $parts =array_filter($parts);
    $parts =array_map('ucfirst',$parts);
    return implode(" ", $parts);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $string =trim($string);
    $skills =explode(",",$string);

    return array_map('trim',$skills);
}

function saveStudent($name,$email,$skillsArray){
    try{
        $file=fopen("students.txt","a");
        if (!$file) {
            throw new Exception("Unable to open file.");

        }
        $data = [
            "Name"   => $name,
            "Email"  => $email,
            "Skills" => $skillsArray,
            "Photo"  => ""
        ];
        $data = json_encode($data) . PHP_EOL;

        fwrite($file,$data);
        fclose($file);
        return true;

    } catch (Exception $e) {
        return $e->getMessage();
    }
}

$errors = [];
$success = "";
$name=$email = $skills = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name =formatName($_POST['name']);
    $email =trim($_POST['email']);
    $skills =$_POST['skills'];

    if (empty($name)) {
        $errors['name'] = "Name is required";
    }

    if (empty($email) || !validateEmail($email)) {
        $errors['email'] ="Email is empty or invalid";
    }
    if (empty($skills)) {
        $errors['skills'] ="Skills are required";
    }
    if (empty($errors)){
        $skillsArray =cleanSkills($skills);
        $result =saveStudent($name,$email, $skillsArray);

        if ($result ===true) {
            $success = "Student data saved successfully!";
            $name = $email = $skills = "";
        } else {
            $errors['file'] = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" href=css/add_student.css>
</head>

<body>
<a href="index.php"><button type="button" class="back-btn">Back to Home</button></a>

<?php include 'include/header.php'; ?>
<form method="post">
    <h2>Add Student Info</h2>

    Name:<br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <div style="color:red"><?= $errors['name'] ?? "" ?></div>

    Email:<br>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>">
    <div style="color:red"><?= $errors['email'] ?? "" ?></div>

    Skills (comma-separated):<br>
    <input type="text" name="skills" value="<?= htmlspecialchars($skills) ?>">
    <div style="color:red"><?= $errors['skills'] ?? "" ?></div>

    <br><br>
    <input type="submit" value="Save Student">

    <div style="color:green"><?= $success ?></div>
    <div style="color:red"><?= $errors['file'] ?? "" ?></div>
</form>

<?php include 'include/footer.php'; ?>

</body>
</html>
