<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rent a beautiful lodge for your holidays. Book online, check availability, and explore nearby attractions.">
    <title>Rayner Lodge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/Assets/Css/home.css" rel="stylesheet">
</head>
<body>

<?php
include('Includes/Navbar.php');
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/Assets/Images/lodgeoutsidepic1.jpg" class="d-block w-100 h-100" alt="Caravan Image 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Welcome to Our Beautiful Lodge</h5>
                <p>Enjoy your stay on the seaside.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/Assets/Images/insidepic1.jpg" class="d-block w-100 h-100" alt="Caravan Image 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Book Now for an Unforgettable Experience</h5>
                <p>Fully furnished and equipped, perfect for families or couples.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/Assets/Images/waltonpierfront.jpg" class="d-block w-100 h-100" alt="Caravan Image 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Explore Nearby Attractions</h5>
                <p>Find the best local spots and make the most of your holiday.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="container my-5">
    <div class="row">
        <div class="col-lg-6">
            <h2>Naze Marine Lodge</h2>
            <p>
                Nestled in the picturesque seaside town Walton-On-The-Naze, our fully furnished lodge is perfect for families, couples, or anyone looking for a tranquil retreat. With all the modern amenities you need and beautiful surroundings, it's a place you'll want to come back to year after year.
            </p>
            <p>
                Our caravan offers two bedrooms, a fully equipped kitchen, a spacious living area, and a private deck with stunning views. Just a short drive from local attractions, it's the ideal base to explore the best of the region.
            </p>
            <a href="#" class="btn btn-primary">Learn More</a>
        </div>
        <div class="col-lg-6">
            <img src="/Assets/Images/outsidesmallpic.jpg" class="img-fluid" alt="Caravan Exterior">
        </div>
    </div>
</section>

<?php
include('Includes/Footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>