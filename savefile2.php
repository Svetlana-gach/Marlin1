<?php 
session_start();

$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost; dbname=new_project;", "root", "root");

$sql = "SELECT * FROM new_project WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$gach = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($gach)) {
	$ma = "Вы уже вводили эту запись.";
	$_SESSION['alarm'] = $ma;

	header("Location: /lesson10.php");
	exit;
}

$sql = "INSERT INTO text (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);



header("Location: /lesson10.php");

?>