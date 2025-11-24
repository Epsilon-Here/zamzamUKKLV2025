<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'inventory_db');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// helper functions
function is_logged_in(){
    return !empty($_SESSION['user']);
}
function require_login(){
    if(!is_logged_in()){
        header('Location: auth/login.php'); exit;
    }
}
function e($v){ return htmlspecialchars($v, ENT_QUOTES); }
function current_user(){ return $_SESSION['user'] ?? null; }
function is_super_admin(){ return (current_user()['role'] ?? '') === 'super_admin'; }
?>