<?php
require_once __DIR__ . "/../db.php";

class Ticket
{

    private PDO $conn;


    public function __construct()
    {
        $db = new Db();
        $this->conn = $db->conn();
    }

    public function getAll()
    {

        $stmt = $this->conn->prepare("SELECT * FROM tickets");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

     public function getOne(int $id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM tickets WHERE id= ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?? null;
    }

    public function add(
        string $title,
        string $description,
        string $priority,
        int $customerId,
        int $adminId
    ) {
        $sql = "
        INSERT INTO tickets 
        (title, description, priority, customer_id, assigned_to)
        VALUES (?, ?, ?, ?, ?)
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $title,
            $description,
            $priority,
            $customerId,
            $adminId
        ]);

        return $stmt->rowCount() > 0 ? 200 : 400;
    }


    public function delete(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tickets WHERE id= ?");
        $deletd = $stmt->execute([$id]);

        if ($deletd)
            return 200;
        else
            return 400;
    }

    public function update(int $id, array $data)
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

        $sql = "UPDATE tickets SET " . implode(", ", $fields) . " WHERE id = ?";
        $values[] = $id;

        $stmt = $this->conn->prepare($sql);
        $updated = $stmt->execute($values);

        if ($updated) {
            return 200;
        } else {
            return 400;
        }
    }

}