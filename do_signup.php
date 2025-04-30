<?php
// start session
session_start();

// database connection
$host = "127.0.0.1";
$database_name = "todolistapp";
$database_user = "root";
$database_password = "";

$db = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
);

// get input from form
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

// validate fields
if (empty($name) || empty($email) || empty($password)) {
    echo "All fields are required";
} else {
    // check if email already exists
    $check = $db->prepare("SELECT * FROM users WHERE email = :email");
    $check->execute(["email" => $email]);
    $existingUser = $check->fetch();

    if ($existingUser) {
        echo "This email is already registered.";
    } else {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // insert into database
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $query = $db->prepare($sql);
        $query->execute([
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        ]);

        echo "Registration successful. <a href='login.php'>Login here</a>";
    }
}
