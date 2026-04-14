<!-- Footer -->
<footer class="footer bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row text-center text-md-start">
            <!-- Admin Links -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold text-light">Admin Panel</h5>
                <ul class="list-unstyled">
                    <li><a href="admin_dashboard.php" class="text-white text-decoration-none">Dashboard</a></li>
                    <li><a href="add_destination.php" class="text-white text-decoration-none">Add Destination</a></li>
                    <li><a href="manage_feedback.php" class="text-white text-decoration-none">Manage Feedback</a></li>
                </ul>
            </div>

            <!-- About -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold text-light">About</h5>
                <p class="small">
                    This admin panel allows you to manage travel destinations and user feedback efficiently.
                    Built for Travel Guide Website.
                </p>
            </div>

            <!-- Social Links -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold text-light">Connect</h5>
                <a href="#" class="text-white me-3 fs-5"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-3 fs-5"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3 fs-5"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white fs-5"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <hr class="border-white" />
        <div class="text-center small">
            &copy; <?= date('Y') ?> Travel Guide Admin. All Rights Reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle JS (includes Popper for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
