<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$adminName = $_SESSION['name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        h1, h2, h3, h5 {
            font-family: 'Volkhov', serif;
            font-weight: bold;
            color: rgb(4, 4, 63);
        }
        h1 { font-size: 4.7rem; }
        h2 { font-size: 3rem; }
        h3 { font-size: 2rem; }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 fixed-top">
    <a class="navbar-brand fw-bold text-white" href="admin_dashboard.php">Travel Guide</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
        <ul class="navbar-nav">
            <li class="nav-item px-3">
                <a class="nav-link text-white fw-semibold" href="admin_dashboard.php">Manage Destinations</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link text-white fw-semibold" href="manage_feedback.php">Manage Feedback</a>
            </li>
            <li class="nav-item dropdown px-3">
                <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($adminName); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Spacing to offset fixed navbar -->
<div style="height: 70px;"></div>
