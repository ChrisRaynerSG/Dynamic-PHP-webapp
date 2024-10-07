<?php
namespace App\Controllers;

class HomeController{
    public function index(){
        require "../App/Views/Home.php";
    }

    public function about(){
        echo "this is a test about page";
    }
}