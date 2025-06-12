<?php
require_once 'models/Book.php';
require_once 'models/Loan.php';

$book = new Book();
$loan = new Loan();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $book_id = intval($_POST["delete_id"]);
        if ($loan->isBookOnLoan($book_id)) {
            throw new Exception("Khong the xoa, sach dang duoc muon!");
        }
        $book->deleteBook($book_id);
        echo "Xoa sach thanh cong!";
    } catch (Exception $e) {
        echo "Loi: " . $e->getMessage();
    }
}
?>