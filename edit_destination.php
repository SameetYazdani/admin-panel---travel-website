<?php
session_start();
include('auth_check.php');
include('includes/admin_header.php');
include('../db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

// Fetch destination
$result = $conn->query("SELECT * FROM destinations WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image uploads
    $image1 = $row['image1'];
    $image2 = $row['image2'];
    $image3 = $row['image3'];

    if (!empty($_FILES['image1']['name'])) {
        $image1 = uniqid() . "_" . $_FILES['image1']['name'];
        move_uploaded_file($_FILES['image1']['tmp_name'], "../images/" . $image1);
    }

    if (!empty($_FILES['image2']['name'])) {
        $image2 = uniqid() . "_" . $_FILES['image2']['name'];
        move_uploaded_file($_FILES['image2']['tmp_name'], "../images/" . $image2);
    }

    if (!empty($_FILES['image3']['name'])) {
        $image3 = uniqid() . "_" . $_FILES['image3']['name'];
        move_uploaded_file($_FILES['image3']['tmp_name'], "../images/" . $image3);
    }

    // Update destination
    $stmt = $conn->prepare("UPDATE destinations SET name=?, description=?, price=?, image1=?, image2=?, image3=? WHERE id=?");
    $stmt->bind_param("ssdsssi", $name, $description, $price, $image1, $image2, $image3, $id);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert alert-success'>Destination updated successfully.</div>";

    // Refresh the row to get new values
    $result = $conn->query("SELECT * FROM destinations WHERE id = $id");
    $row = $result->fetch_assoc();
}
?>

<div class="container mt-5 col-md-6">
    <h2 >Edit Destination</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mt-5"><label><h5>Name</h5></label><input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required></div>
        <div class="mt-4"><label><h5>Description</h5></label><textarea name="description" class="form-control" required><?= $row['description'] ?></textarea></div>
        <div class="mt-4"><label><h5>Price</h5></label><input type="number" step="0.01" name="price" class="form-control" value="<?= $row['price'] ?>" required></div>

        <div class="mt-5">
            <h5>Images</h5>
            <label class=" h6 mt-3 ">Current Image 1</label><br>
            <img src="../images/<?= $row['image1'] ?>" width="100"><br>
            <input type="file" name="image1" class="form-control mt-1">
        </div>

        <div class="mb-3 mt-3">
            <label class="h6 mt-3">Current Image 2</label><br>
            <img src="../images/<?= $row['image2'] ?>" width="100"><br>
            <input type="file" name="image2" class="form-control mt-1">
        </div>

        <div class="mb-3 mt-3">
            <label class="h6 mt-3">Current Image 3</label><br>
            <img src="../images/<?= $row['image3'] ?>" width="100"><br>
            <input type="file" name="image3" class="form-control mt-1">
        </div>

        <button type="submit" class="btn btn-primary mb-5 mt-3">Update Destination</button>
    </form>
</div>

<?php include('includes/admin_footer.php'); ?>
