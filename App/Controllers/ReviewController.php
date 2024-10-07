<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\ReviewModel;

class ReviewController{

    private $reviewModel;

    public function __construct(){
        $database = new Database();
    }

    public function index(){
        require "../App/Views/Reviews.php";
    }

}