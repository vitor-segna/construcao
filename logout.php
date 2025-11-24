<?php
session_start();
session_destroy();
header("Location: ../menu/menu.php");
exit;
?>
