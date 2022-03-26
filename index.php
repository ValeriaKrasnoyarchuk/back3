<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {  
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}
 
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];
$radio1 = $_POST['radio-group-1'];
$radio2 = $_POST['radio-group-2'];
$power = implode(',', $_POST['superpowers']);
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

$user = 'u47505';
$pass = '5503713';
$db = new PDO('mysql:host=localhost;dbname=u47505', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO clients SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?, policy = ?");
    $stmt->execute(array($name, $email, $date, $radio1, $radio2, $bio, $check1));
    $user_id = $db->lastInsertId();

    $superpowers = $db->prepare("INSERT INTO powers SET powers = ?, user_id = ? ");
    $superpowers->execute(array($power, $user_id));
} catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}
header('Location: ?save=1');
