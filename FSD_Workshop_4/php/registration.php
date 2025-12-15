<?php
header("Content-Type: application/json");

// Read JSON data from JS
$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';
$confirm_password = $data['password2'] ?? '';

$errors = [];

/* ==========================
   Validation
   ========================== */
if ($name === '') {
    $errors['name'] = "Name is required.";
}

if ($email === '') {
    $errors['email'] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}

if ($password === '') {
    $errors['password'] = "Password is required.";
} elseif (strlen($password) < 8) {
    $errors['password'] = "Password must be at least 8 characters.";
} elseif (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
    $errors['password'] = "Password must contain at least one special character.";
}

if ($password !== $confirm_password) {
    $errors['confirm'] = "Passwords do not match.";
}

/* ==========================
   STOP if ANY error
   ========================== */
if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    exit();
}

/* ==========================
   File handling
   ========================== */
$file = "../users.json";

if (!file_exists($file)) {
    echo json_encode(["errors" => ["file" => "User database not found."]]);
    exit();
}

$users = json_decode(file_get_contents($file), true);
if (!is_array($users)) {
    $users = [];
}

/* ==========================
   Hash password & append
   ========================== */
$users[] = [
    "name" => $name,
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)
];

/* ==========================
   Write updated array
   ========================== */
if (file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT)) === false) {
    echo json_encode(["errors" => ["file" => "Failed to save user data."]]);
    exit();
}

/* ==========================
   Success
   ========================== */
echo json_encode(["success" => "Successfully Registered"]);
exit();
