<?php
ob_start();
session_start();

include('auth_check.php');
include('includes/admin_header.php');
include('../db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Delete destination
if (isset($_GET['delete_destination'])) {
    $id = intval($_GET['delete_destination']);
    $conn->query("DELETE FROM destinations WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}



// Delete feedback
if (isset($_GET['delete_feedback'])) {
    $id = intval($_GET['delete_feedback']);
    $conn->query("DELETE FROM destination_feedback WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}
?>

<div class="container mb-5 ">
    <h1 class="text-center mb-4" style="margin-top: 100px;">Admin Dashboard</h1>

    <!-- Destinations Section -->
    <div class="d-flex justify-content-between align-items-center mb-3 my-5">
        <h3 class="mt-5">Manage Destinations</h3>
        <a href="add_destination.php" class="btn btn-primary mt-5 ">+ Add Destination</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (Rs)</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM destinations");
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td style='max-width:300px; white-space:pre-wrap;'>" . nl2br(htmlspecialchars($row['description'])) . "</td>
                    <td>" . number_format($row['price']) . "</td>
                      <td>
                        <img src='../images/{$row['image1']}' width='70' height='50' class='img-thumbnail me-1'>
                        <img src='../images/{$row['image2']}' width='70' height='50' class='img-thumbnail me-1'>
                        <img src='../images/{$row['image3']}' width='70' height='50' class='img-thumbnail'>
                    </td>
                    <td>
                        <a href='edit_destination.php?id={$row['id']}' class='btn btn-sm btn-warning mb-1'>Edit</a>
                        <a href='?delete_destination={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this destination?')\">Delete</a>
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr class="my-5">

     
</div>

<?php include('includes/admin_footer.php'); ?>
<?php ob_end_flush(); ?>