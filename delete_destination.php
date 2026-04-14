<?php
include('auth_check.php');
include('db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM destinations WHERE id = $id");
}

header("Location: admin_dashboard.php");
exit();
