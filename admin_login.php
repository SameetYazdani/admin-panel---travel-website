<?php
session_start();
include '../db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM admins WHERE email = '$email'");
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $admin['name'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
     h1,
     h2,
     h3,
     h5 {
       font-family: 'Volkhov', serif;
       font-weight: bold;
       color: rgb(4, 4, 63);
     }

     h1 {
       font-size: 4.7rem;
     }

     h2 {
       font-size: 3rem;
     }

     h3 {
       font-size: 2rem;
     }
   </style>
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-5 ">Admin Login</h3>

        <?php if ($message): ?>
            <div class="alert alert-danger text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label><h5>Email</h5></label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3 mt-5">
                <label><h5>Password</h5></label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>

