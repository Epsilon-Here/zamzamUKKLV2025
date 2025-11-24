<?php
require_once __DIR__ . '/../config.php';
require_login();
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare('SELECT * FROM transactions WHERE id=?'); $stmt->execute([$id]); $t=$stmt->fetch();
if(!$t) { header('Location:index.php'); exit; }
if($t['returned_at']){ header('Location:index.php'); exit; }
$pdo->beginTransaction();
try{
    $pdo->prepare('UPDATE transactions SET returned_at=NOW(), type = "borrow" WHERE id = ?')->execute([$id]);
    $pdo->prepare('UPDATE items SET stock = stock + 1 WHERE id = ?')->execute([$t['item_id']]);
    $pdo->commit();
}catch(Exception $e){
    $pdo->rollBack();
}
header('Location:index.php'); exit;
