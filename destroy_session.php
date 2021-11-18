<?php
session_start();
session_destroy();

$redir = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'home.php';
header('Location: '.$redir);
exit();