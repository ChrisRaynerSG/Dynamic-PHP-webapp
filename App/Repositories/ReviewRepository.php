<?php

namespace App\Repositories;

use App\Models\Review;
use App\Database\Database;
use PDO;

class ReviewRepository{


    private $pdo;

    public function __construct(){
        $database = new Database();
        $this->pdo = $database->connect();
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

    public function getAllReviews($rating = '', $limit = 10, $offset = 0){
        $sql = "SELECT * FROM reviews";
        if ($rating !== '') {
            $sql .= ' WHERE rating = :rating';
        }
        $sql .= ' ORDER BY created_at DESC LIMIT :limit OFFSET :offset';
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
        if ($rating !== '') {
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalReviews($rating = ''){
        $sql = "SELECT COUNT(*) as count FROM reviews";
        if ($rating !== '') {
            $sql .= ' WHERE rating = :rating';
        }
    
        $stmt = $this->pdo->prepare($sql);
    
        if ($rating !== '') {
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}