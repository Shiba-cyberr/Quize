<?php
// Include the database connection file
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input (basic validation)
    if (empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insert user data into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed_password
        ]);

        echo "Registration successful! You can now log in.";
    } catch (\PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
            echo "Email already exists. Please use a different email.";
        } else {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
?>