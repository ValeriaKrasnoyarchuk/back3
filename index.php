<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {  
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('index.html');
  exit();
}
 
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];
$radio1 = $_POST['radio-group-1'];
$radio2 = $_POST['radio-group-2'];
$power = $_POST['superpowers'];
$bio = $_POST['biography'];
$check1 = $_POST['check-1'];

$errors = FALSE;
if ($name=='') {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if ($email=='') {
  print('Заполните email.<br/>');
  $errors = TRUE;
}

if ($date=='') {
  print('Заполните дату рождения.<br/>');
  $errors = TRUE;
}

if ($radio1=='') {
  print('Заполните данные.<br/>');
  $errors = TRUE;
}

if ($radio2=='') {
  print('Заполните данные.<br/>');
  $errors = TRUE;
}

if ($power=='') {
  print('Заполните данные.<br/>');
  $errors = TRUE;
}

if ($bio=='') {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
}

if ($check1=='') {
  print('Примите условия.<br/>');
  $errors = TRUE;
}

if ($errors) {
  exit();
}

$user = 'u24531';
$pass = '5078774';
$db = new PDO('mysql:host=localhost;dbname=u24531', $user, $pass, array(PDO::ATTR_PERSISTENT => true));


try {
  $stmt = $db->prepare("INSERT INTO form (name,email,date,radio1,radio2,power,bio,check1) VALUE(:name,:email,:date,:radio1,:radio2,:power,:bio,:check1)");
  $stmt -> execute(['name'=>$name,'email'=>$email,'date'=>$date,'radio1'=>$radio1,'radio2'=>$radio2,'power'=>$power,'bio'=>$bio,'check1'=>$check1]);
  print('Спасибо, результаты сохранены.<br/>');
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}