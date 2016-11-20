<?php

include_once '../../models/Include.php';

$user->user = htmlentities($_POST['user']);
$user->pass = htmlentities(md5($_POST['pass']));
$user->rememberToken = $user->pass;
$user->level = htmlentities($_POST['level']);

$user->create();

?>