<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
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

    $sql = "DELETE FROM todos WHERE id =:id";

    $query = $database ->prepare ( $sql );

    $query->execute([
        "id" => $name
    ]);



    header("Location: index.php");
    exit;