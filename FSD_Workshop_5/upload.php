<?php

function getStudents() {
    if (!file_exists("students.txt")) {
        return [];
    }

    $lines =file("students.txt", FILE_IGNORE_NEW_LINES);
    $students =[];

    foreach ($lines as $line) {
        $students[] = json_decode($line, true);
    }
    return $students;
}


function saveAllStudents($students) {
    $file = fopen("students.txt", "w");
    foreach ($students as $student) {
        fwrite($file, json_encode($student) . PHP_EOL);
    }
    fclose($file);
}

function uploadPortfolioFile($file, $email) {
    try {
        $allowedTypes = ['pdf','jpg','jpeg', 'png'];
        $maxSize = 2 * 1024 * 1024; 
        $uploadDir = "upload/";

        if (!is_dir($uploadDir)) {
            throw new Exception("Upload directory does not exist.");
        }

        if ($file['size'] > $maxSize) {
            throw new Exception("File size exceeds 2MB.");
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) {
            throw new Exception("Only PDF, JPG, PNG files are allowed.");
        }

        $students = getStudents();
        $found = false;

        foreach ($students as &$student) {
            if ($student['Email'] === $email) {
                $found = true;

                $safeEmail = str_replace("@", "_", $email);
                $newName = $safeEmail . "_" . time() . "." . $ext;
                $destination = $uploadDir . $newName;

                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    throw new Exception("File upload failed.");
                }

                $student['Photo'] = $newName;
                break;
            }
        }

        if (!$found) {
            throw new Exception("Student not found. Add student first.");
        }

        saveAllStudents($students);

        return "File uploaded and linked to student successfully.";

    } catch (Exception $e) {
        return $e->getMessage();
    }
}


$message = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);

    if (empty($email)) {
        $message = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif (isset($_FILES['portfolio'])) {
        $message = uploadPortfolioFile($_FILES['portfolio'], $email);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Portfolio</title>
    <link rel="stylesheet" href="css/upload.css">
</head>

<body>
<a href="index.php"><button type="button" class="back-btn">Back to Home</button></a>
<?php include 'include/header.php'; ?>

<form method="post" enctype="multipart/form-data">
    <h2>Upload Portfolio</h2>

    Student Email:<br>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

    Select File:<br>
    <input type="file" name="portfolio" required><br><br>

    <input type="submit" id ="submit_btn"value="Upload">

    <p style="color:blue"><?= $message ?></p>
</form>

<?php include 'include/footer.php'; ?>

</body>
</html>
