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

        $reviews = $this->reviewRepository->getAllReviews($ratingFilter, $limit, ($page-1)*$limit);
        $totalPages = $this->reviewRepository->getTotalReviews($ratingFilter);
        $totalPages = ceil($totalPages / $limit);

        require "../App/Views/Reviews.php";
    }

}