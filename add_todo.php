<?php
  $host = "127.0.0.1";
  $database_name = "todolistapp";
  $database_user = "root";
  $database_password = "";

  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );

  $sql = "SELECT * FROM todos";
  $query = $database->prepare( $sql );
  $query->execute();
  $todos = $query->fetchAll();

$name = $_POST["name"];

if ( empty ($name) ) {
    echo "Please fill a new task";
} else{
    $sql = "INSERT INTO todos (`name`) Value (:name)";
    $query = $database->prepare ($sql);
    $query->execute([
        "name" => $name
    ]);
}

header("Location: index.php");
exit;