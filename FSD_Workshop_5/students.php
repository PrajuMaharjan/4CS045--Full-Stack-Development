<?php

function getStudents() {
    if (!file_exists("students.txt")) {
        return [];
    }

    $lines = file("students.txt", FILE_IGNORE_NEW_LINES);
    $students = [];

    foreach ($lines as $line) {
        $students[] = json_decode($line, true);
    }

    return $students;
}

$students = getStudents();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Students</title>
    <link rel="stylesheet" href="css/students.css">
</head>
<body>
<a href="index.php"><button type="button" class="back-btn">Back to Home</button></a>
<?php include 'include/header.php'; ?>

<h2>All Students</h2>

<?php if (empty($students)): ?>
    <p>No students found.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0"class ="students-table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Skills</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['Name']) ?></td>
                <td><?= htmlspecialchars($student['Email']) ?></td>
                <td>
                    <ul>
                        <?php foreach ($student['Skills'] as $skill): ?>
                            <li><?= htmlspecialchars($skill) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include 'include/footer.php'; ?>

</body>
</html>
