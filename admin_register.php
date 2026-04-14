<?php
include '../db.php'; // adjust path if needed
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if ($name && $email && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            $message = "✅ Admin added successfully.";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add Admin</h4>
            </div>
            <div class="card-body">
                <?php if ($message): ?>
                    <div class="alert alert-info"><?= $message ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Admin</button>
                    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
