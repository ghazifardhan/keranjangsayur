<?php

session_start();

include 'models/Include.php';

$username  = htmlentities($_POST['user']);
$user->user = $username;
$password = htmlentities(md5($_POST['pass']));


$stmt = $user->Auth();

$row = $stmt->fetch(PDO::FETCH_OBJ);

if($row->user == $username && $row->pass == $password)
{   
    $_SESSION['user'] = $row->user;
	$_SESSION['level'] = $row->level;
    header('Location: /keranjangsayur/views/app.php');
} else
{
    header('Location: /keranjangsayur/index.php?msg=login_failed');
}

?>