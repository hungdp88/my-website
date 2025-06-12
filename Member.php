<?php
require_once 'Model.php';

class Member extends Model {
    public function getAllMembers() {
        $stmt = $this->pdo->query("SELECT * FROM members ORDER BY membership_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMemberById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertMember($name, $email) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO members (name, email) VALUES (?, ?)");
            $stmt->execute([$name, $email]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi thêm thành viên: " . $e->getMessage());
        }
    }
}
?>