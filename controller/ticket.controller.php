<?php
require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../enums/priority.ticket.php";


readonly class Ticket  // readonly class 
{

    private PDO $conn;


    public function __construct()
    {
        $db = new Db();
        $this->conn = $db->conn();
    }

    public function getAll(): array
    {

        $stmt = $this->conn->prepare("SELECT * FROM tickets");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getOne(int | string $id) // Union Types
    {

        $stmt = $this->conn->prepare("SELECT * FROM tickets WHERE id= ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?? null;
    }

    public function add( // Union Types
        string $title,
        string $description,
        Priority $priority,
        int|string $customerId,
        int|string $adminId
    ): int {
        
        $sql = "
        INSERT INTO tickets 
        (title, description, priority, customer_id, assigned_to)
        VALUES (?, ?, ?, ?, ?)
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $title,
            $description,
            $priority->name,
            $customerId,
            $adminId
        ]);

        return $stmt->rowCount() > 0 ? 200 : 400;
    }


    public function delete(int|string $id): int|string // Union Types
    {
        $stmt = $this->conn->prepare("DELETE FROM tickets WHERE id= ?");
        $deletd = $stmt->execute([$id]);

        if ($deletd)
            return 200;
        else
            return "Delete Error";
    }

    public function update(int|string $id, array $data): int|string // Union Types
    {
        $fields = [];
        $values = [];

        if (!empty($data['title'])) {
            $fields[] = "title = ?";
            $values[] = $data['title'];
        }

        if (!empty($data['description'])) {
            $fields[] = "description = ?";
            $values[] = $data['description'];
        }

        if (!empty($data['status'])) {
            $fields[] = "status = ?";
            $values[] = $data['status'];
        }

        if (!empty($data['priority'])) {
            $fields[] = "priority = ?";
            $values[] = $data['priority'];
        }

        if (empty($fields)) {
            return 400;
        }

        $sql = "UPDATE tickets SET " . implode(separator: ", ", array: $fields) . " WHERE id = ?";
        $values[] = $id;

        $finalVlaue = [...$values, $id]; // Unpacking Array;

        $stmt = $this?->conn?->prepare(query: $sql); // Nullsafe Operator (?->)
        $updated = $stmt?->execute(params: $finalVlaue); // Nullsafe Operator (?->)

        if ($updated) {
            return 200;
        } else {
            return "update Failed";
        }
    }

}