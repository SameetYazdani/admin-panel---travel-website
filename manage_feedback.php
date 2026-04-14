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
// Approve feedback
if (isset($_GET['approve_feedback'])) {
    $id = intval($_GET['approve_feedback']);
    $conn->query("UPDATE destination_feedback SET approved = 1 WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}

// Delete feedback
if (isset($_GET['delete_feedback'])) {
    $id = intval($_GET['delete_feedback']);
    $stmt = $conn->prepare("DELETE FROM destination_feedback WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Feedback deleted successfully.'); window.location='manage_feedback.php';</script>";
    } else {
        echo "<script>alert('Failed to delete feedback.');</script>";
    }
}
?>



 <!-- Feedback Section -->
  <div class="container" style="margin-bottom: 200px;" >
    <h3 class="mb-3" style="margin-top: 150px;" >Manage Feedback</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center ">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Destination</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $res = $conn->query("SELECT * FROM destination_feedback ORDER BY created_at DESC");
                while ($row = $res->fetch_assoc()) {
                    $status = $row['approved'] ? 'Approved' : 'Pending';
                    echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td>" . htmlspecialchars($row['destination']) . "</td>
                    <td>" . str_repeat("⭐", (int)$row['rating']) . "</td>
                    <td style='max-width:300px;'>" . nl2br(htmlspecialchars($row['comment'])) . "</td>
                    <td>$status</td>
                    <td>
                        " . ($row['approved'] ? "" : "<a href='?approve_feedback={$row['id']}' class='btn btn-success btn-sm mb-1'>Approve</a>") . "
                        <a href='?delete_feedback={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Delete this feedback?')\">Delete</a>
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include('includes/admin_footer.php'); ?>

<?php ob_end_flush(); ?>