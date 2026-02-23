<?php
/**
 * User Model
 */
class User {
    private $db;
    private $table = 'users';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Find user by email
     */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT u.*, r.name as role_name, r.description as role_description 
                                    FROM {$this->table} u 
                                    JOIN roles r ON u.role_id = r.id 
                                    WHERE u.email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Find user by ID
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT u.*, r.name as role_name, r.description as role_description 
                                    FROM {$this->table} u 
                                    JOIN roles r ON u.role_id = r.id 
                                    WHERE u.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Verify password
     */
    public function verifyPassword($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Create new user
     */
    public function create($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, email, password, role_id) 
                                    VALUES (?, ?, ?, ?)");
        
        try {
            $stmt->execute([
                $data['name'],
                $data['email'],
                $hashedPassword,
                $data['role_id'] ?? 3 // Default to viewer
            ]);
            return $this->findById($this->db->lastInsertId());
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update user
     */
    public function update($id, $data) {
        $fields = [];
        $params = [];

        if (isset($data['name'])) {
            $fields[] = 'name = ?';
            $params[] = $data['name'];
        }
        if (isset($data['email'])) {
            $fields[] = 'email = ?';
            $params[] = $data['email'];
        }
        if (isset($data['password'])) {
            $fields[] = 'password = ?';
            $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        if (isset($data['role_id'])) {
            $fields[] = 'role_id = ?';
            $params[] = $data['role_id'];
        }
        if (isset($data['is_active'])) {
            $fields[] = 'is_active = ?';
            $params[] = $data['is_active'];
        }

        if (empty($fields)) {
            return false;
        }

        $params[] = $id;
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Get all users
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT u.id, u.name, u.email, u.is_active, u.created_at, r.name as role_name 
                                    FROM {$this->table} u 
                                    JOIN roles r ON u.role_id = r.id 
                                    ORDER BY u.created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Check if email exists
     */
    public function emailExists($email, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE email = ? AND id != ?");
            $stmt->execute([$email, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE email = ?");
            $stmt->execute([$email]);
        }
        return $stmt->fetch() !== false;
    }
}
