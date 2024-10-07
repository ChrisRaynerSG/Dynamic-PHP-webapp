<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\ReviewModel;

class ReviewController{
    // private $reviewModel;

    // public function __construct(){
    //     $database = new Database();

    //     $this->reviewModel = new Review($database->connect());
    // }

    public function index(){
        require "../App/Views/Reviews.php";
    }

}