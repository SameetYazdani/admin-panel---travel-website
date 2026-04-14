<?php
 
// Redirect to login if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$adminName = $_SESSION['admin_username'];
?>

<?php include('includes/admin_header.php'); ?>
<div class="container mt-4">
     <h4>Welcome, <?php echo htmlspecialchars($adminName); ?> 👋</h4>
<p>This is your admin dashboard. Manage content here.</p>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
