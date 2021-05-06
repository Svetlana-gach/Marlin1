<?php 

$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost; dbname=new_project;", "root", "root");
$sql = "INSERT INTO text (text) VALUES (:message)";
$statement = $pdo->prepare($sql);
$statement->execute(['message' => $text]);
header("Location: /task9_new.php");

?>