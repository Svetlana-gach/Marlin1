<?php 
session_start();

$email = $_POST["email"];
$password = $_POST["password"];






//соединяемся с базой
$pdo = new PDO("mysql:host=localhost;dbname=register; charset=utf8", "root", "root");

//ПРОВЕРКА по имейл
$sql = "SELECT * FROM users WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

//ЦИКЛ
if(!empty($user)){
	$_SESSION["danger"] = "Этот эл. адрес уже занят другим пользователем.";
	header("Location: /page_register.php");
	exit; }


//прописываю скл запрос
$sql =  "INSERT INTO users (email, password) VALUES (:email, :password)";
//подготовить запрос и передать сразу в переменную
$statement = $pdo->prepare($sql);
//вызвать ф-ию выполнения запроса, куда в массиве передать значения, кот. потом подставятся в метки :имейл и :пароль
$statement->execute([
	"email" => $email,
	"password" => password_hash($password, PASSWORD_DEFAULT)]);


$_SESSION["success"] = "Регистрация успешна";
header("Location: /page_login.php");
exit;
?>