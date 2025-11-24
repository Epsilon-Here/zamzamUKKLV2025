<?php
require_once("config.php");
var_dump($pdo->query("SELECT DATABASE()")->fetch());
?>
