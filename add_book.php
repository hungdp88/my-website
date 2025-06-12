<?php
require_once 'models/Book.php';
$book = new Book();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $published_year = intval($_POST["published_year"]);
        $copies = intval($_POST["copies"]);

        if (empty($title) || empty($author) || $published_year <= 0 || $copies < 1) {
            throw new ValidationException("Dữ liệu không hợp lệ!");
        }

        $book->insertBook($title, $author, $published_year, $copies);
        echo "Them sach thanh cong!";
    } catch (ValidationException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>