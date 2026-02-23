<?php
/**
 * Role Model
 */
class Role {
    private $db;
    private $table = 'roles';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get role by ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Get role by name
     */
    public function getByName($name) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch();
    }

    /**
     * Get all roles
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    /**
     * Get role permissions (for route guard)
     */
    public function getPermissions($roleId) {
        $role = $this->getById($roleId);
        $permissions = [
            'admin' => ['dashboard', 'users', 'users.add', 'users.edit', 'users.delete', 'settings', 'reports'],
            'manager' => ['dashboard', 'users', 'reports'],
            'viewer' => ['dashboard']
        ];
        return $permissions[$role['name']] ?? [];
    }
}
