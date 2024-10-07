<?php
$reviews = $reviews ?? [];
$page = $page ?? 1;
$totalPages = $totalPages ?? 1;
$searchRating = $searchRating ?? '';
$error = $error ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="Rent a beautiful lodge for your holidays. Book online, check availability, and explore nearby attractions.">
    <title>Rayner Lodge - Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Rayner Lodge Rental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book.php">Book Now</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="directions.php">Directions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About the Place</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h2 class="mb-4">Customer Reviews</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-auto">
            <label for="rating" class="col-form-label">Filter by Rating:</label>
        </div>
        <div class="col-auto">
            <select name="rating" id="rating" class="form-select">
                <option value="">All Ratings</option>
                <?php for($i=1; $i<=5; $i++): ?>
                    <option value="<?= $i ?>" <?= ($searchRating === $i) ? 'selected' : '' ?>><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Search</button>
        </div>
    </form>

    <?php if ($reviews): ?>
        <nav aria-label="Review pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" tabindex="-1">Previous</a>
                </li>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php foreach ($reviews as $review): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($review['username']) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="bi <?= ($i <= $review['rating']) ? 'bi-star-fill text-warning' : 'bi-star' ?>"></i>
                        <?php endfor; ?>
                    </h6>
                    <p class="card-text"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                    <p class="card-text"><small class="text-muted">Reviewed on <?= date("F j, Y, g:i a", strtotime($review['created_at'])) ?></small></p>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <nav aria-label="Review pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" tabindex="-1">Previous</a>
                </li>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next</a>
                </li>
            </ul>
        </nav>
    <?php else: ?>
        <p>No reviews found.</p>
    <?php endif; ?>

    <div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title">Submit a Review</h5>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="/reviews/submit">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="100" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div id="star-rating" class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star" data-rating="<?= $i ?>"></i>
                    <?php endfor; ?>
                </div>
                <!-- Hidden input to store the selected rating value -->
                <input type="hidden" name="rating" id="ratingInput" required value="<?= isset($_POST['rating']) ? htmlspecialchars($_POST['rating']) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Your Review</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required maxlength="1000"><?= isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '' ?></textarea>
            </div>
            <button type="submit" name="submit_review" class="btn btn-success">Post Review</button>
        </form>
    </div>
</div>
                    </div>

<script>
    // JavaScript to handle star rating click events
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-rating i');
        const ratingInput = document.getElementById('ratingInput');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating; // Set the value of the hidden rating input

                // Update star appearance based on selection
                stars.forEach(s => s.classList.remove('bi-star-fill'));
                stars.forEach(s => s.classList.add('bi-star'));

                // Fill the stars up to the selected rating
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.remove('bi-star');
                    stars[i].classList.add('bi-star-fill');
                }
            });
        });
    });
</script>

<footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h5>Contact Us</h5>
                <p>Email: <a href="mailto:lisajrayner@aol.com">lisajrayner@aol.com</a></p>
                <p>Phone: <a href="tel:+447834600060">07834 600060</a></p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <h5>Follow Us</h5>
                <a href="#" class="me-3"><i class="bi bi-facebook" style="font-size: 1.5rem;"></i></a>
                <a href="#" class="me-3"><i class="bi bi-twitter" style="font-size: 1.5rem;"></i></a>
                <a href="#"><i class="bi bi-instagram" style="font-size: 1.5rem;"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-white">
        &copy; 2024 Rayner Lodge. All Rights Reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
