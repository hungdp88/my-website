<?php
require_once 'Model.php';

class Book extends Model {
    public function getAllBooks() {
        $sql = "SELECT books.*, (books.copies - IFNULL(loans_count.loans, 0)) AS available_copies 
                FROM books 
                LEFT JOIN (SELECT book_id, COUNT(*) AS loans FROM loans WHERE return_date IS NULL GROUP BY book_id) loans_count 
                ON books.id = loans_count.book_id
                ORDER BY published_year DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertBook($title, $author, $published_year, $copies) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author, published_year, copies) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $author, $published_year, $copies]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Loi khi them sach: " . $e->getMessage());
        }
    }
}