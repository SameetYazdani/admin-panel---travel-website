<?php
session_start();
include('auth_check.php');
include('includes/admin_header.php');
include('../db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    $targetDir = "images/";
    move_uploaded_file($_FILES["image1"]["tmp_name"], $targetDir . $image1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $targetDir . $image2);
    move_uploaded_file($_FILES["image3"]["tmp_name"], $targetDir . $image3);

    $stmt = $conn->prepare("INSERT INTO destinations (name, description, price, image1, image2, image3) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $name, $description, $price, $image1, $image2, $image3);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert alert-success'>Destination added successfully.</div>";
}
?>

<div class="container mt-5 col-md-6" style="margin-bottom: 200px;">
    <h2 class="p-3">Add Destination</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-4"><label><h5>Name</h5></label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label><h5>Description</h5></label><textarea name="description" class="form-control" required></textarea></div>
        <div class="mb-3"><label><h5>Price</h5></label><input type="number" step="0.01" name="price" class="form-control" required></div>
        <div class="mb-3 mt-4"><label><h5>Image 1</h5></label><input type="file" name="image1" class="form-control" required></div>
        <div class="mb-3 mt-4"><label><h5>Image 2</h5></label><input type="file" name="image2" class="form-control" required></div>
        <div class="mb-3 mt-4"><label><h5>Image 3</h5></label><input type="file" name="image3" class="form-control" required></div>
        <button type="submit" class="btn btn-primary mt-5">Add Destination</button>
    </form>
</div>

<?php include('includes/admin_footer.php'); ?>
