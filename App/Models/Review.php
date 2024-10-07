<?php

namespace App\Models;


class Review{

    private $username;
    private $rating;
    private $comment;
    private $timestamp;

    public function __construct($username, $rating, $comment){
        $this->username = $username;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->timestamp = date('Y-m-d H:i:s');
    }
}