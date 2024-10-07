<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\ReviewModel;
use App\Repositories\ReviewRepository;

class ReviewController{

    private $reviewRepository;

    public function __construct(){
        $this->reviewRepository = new ReviewRepository();
    }

    public function index(){
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1);
    
        $ratingFilter = isset($_GET['rating']) ? $_GET['rating'] : '';
    
        $reviews = $this->reviewRepository->getAllReviews($ratingFilter, $limit, ($page - 1) * $limit);
        $totalReviews = $this->reviewRepository->getTotalReviews($ratingFilter);
        $totalPages = ceil($totalReviews / $limit);
    
        require "../App/Views/Reviews.php";
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['name'] ?? '';
            $rating = (int)$_POST['rating'] ?? 0;
            $comment = $_POST['comment'] ?? '';

            if (!empty($username) && $rating >= 1 && $rating <= 5 && !empty($comment)) {
                $success = $this->reviewRepository->createReview($username, $rating, $comment);
                if ($success) {
                    header('Location: /reviews?success=1');
                    exit;
                } else {
                    $error = "An error occurred while submitting your review. Please try again.";
                }
            } else {
                $error = "Please fill out all fields correctly.";
            }
            require "../App/Views/Reviews.php";
        }
    }

}