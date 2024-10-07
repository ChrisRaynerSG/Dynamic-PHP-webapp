<?php

namespace App\Repositories;

use App\Models\Review;
use PDO;

class ReviewRepository{


    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function createReview($username, $rating, $comment): bool{

        $sql = "INSERT INTO reviews (username, rating, comment, timestamp) VALUES (:username, :rating, :comment, :timestamp)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => htmlspecialchars($username),
            ':rating' => $rating,
            ':comment' => htmlspecialchars($comment),
            ':timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    public function getTotalReviews(){
        $sql = "SELECT COUNT(*) FROM reviews";
        return $this->pdo->query($sql)->fetchColumn();
    }
}