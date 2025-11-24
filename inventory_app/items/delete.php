<?php
require_once __DIR__ . '/../config.php';
require_login();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('DELETE FROM items WHERE id=?');
$stmt->execute([$id]);
header('Location: index.php'); exit;
