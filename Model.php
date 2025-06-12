<?php
abstract class Model {
    protected $pdo;

    public function __construct() {
        $config = require_once '../config.php';
        try {
            $this->pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Loi ket noi: " . $e->getMessage());
        }
    }
}