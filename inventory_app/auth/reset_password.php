<?php
require_once("../config.php");

$newPassword = "admin123"; // password baru

$hash = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET `password` = ? WHERE email = ?");
$stmt->execute([$hash, "super@domain.test"]);

echo "Password berhasil diubah!<br>";
echo "Login pakai:<br><br>";
echo "Email: super@domain.test<br>";
echo "Password: $newPassword<br>";
?>
