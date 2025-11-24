<?php
require_once __DIR__ . '/../config.php';
require_login();
if(!is_super_admin()) die('Unauthorized');
$id=(int)($_GET['id']??0);
$pdo->prepare('DELETE FROM users WHERE id=?')->execute([$id]);
header('Location: index.php'); exit;