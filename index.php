<?php
require_once 'models/Book.php';
$book = new Book();
$books = $book->getAllBooks();
?>

<table>
    <tr>
        <th>Tieu De</th>
        <th>Tac gia</th>
        <th>Nam xuat ban</th>
        <th>Con lai</th>
        <th>Hanh dong</th>
    </tr>
    <?php foreach ($books as $b): ?>
    <tr>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['author']) ?></td>
        <td><?= $b['published_year'] ?></td>
        <td><?= $b['available_copies'] ?></td>
        <td>
            <a href="edit_book.php?id=<?= $b['id'] ?>">Sua</a> |
            <a href="view_loans.php?book_id=<?= $b['id'] ?>">Xem muon</a> |
            <form method="POST" action="delete_book.php">
                <input type="hidden" name="delete_id" value="<?= $b['id'] ?>">
                <button type="submit" onclick="return confirm('Ban co chac muon xoa sach khong?')">Xoa</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>