<?php
$host = "localhost";
$database = "school_db";
$user = "root";
$password = "";

try {
    $pdo=new PDO("mysql:host=$host;dbname=$database",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("Database connection failed");
}
if ($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['add_student'])) {
    $sql="INSERT INTO students (name,email,course) VALUES (?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['course']]);
}

if (isset($_GET['delete'])) {
    $stmt=$pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_GET['delete']]);
}
if ($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['update_student'])) {
    $sql="UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['course'],
        $_POST['id']
    ]);
}
$students = $pdo->query("SELECT * FROM students ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>CRUD Operations</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Add Student</h2>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Course: <input type="text" name="course" required><br><br>
    <button type="submit" name="add_student">Add</button>
</form>

<h2>Student Records</h2>
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Actions</th>
</tr>
<?php 
	foreach ($students as $s): 
?>
<tr>
<td><?= $s['id'] ?></td>    
<td><?= htmlspecialchars($s['name']) ?></td>
<td><?= htmlspecialchars($s['email']) ?></td>
<td><?= htmlspecialchars($s['course']) ?></td>
<td>
    <button onclick="openpopup(<?= $s['id'] ?>,'<?= $s['name'] ?>','<?= $s['email'] ?>','<?= $s['course'] ?>')">Edit</button>
    <a href="?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
</td>
</tr>

<?php
 endforeach;
?>

</table>

<div class="popup" id="editpopup">
<div class="popup-content">
<h3>Edit Student</h3>
<form method="post">
<input type="hidden" name="id" id="edit_id">
Name: <input type="text" name="name" id="edit_name"><br>
Email: <input type="email" name="email" id="edit_email"><br>
Course: <input type="text" name="course" id="edit_course"><br><br>
<button type="submit" name="update_student">Update</button>
<button type="button" onclick="closepopup()">Cancel</button>
</form>
</div>
</div>

<script>

function openpopup(id, name, email, course) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_email").value = email;
    document.getElementById("edit_course").value = course;
    document.getElementById("editpopup").style.display = "block";
}

function closepopup() {
    document.getElementById("editpopup").style.display = "none";
}
</script>
</body>
</html>
