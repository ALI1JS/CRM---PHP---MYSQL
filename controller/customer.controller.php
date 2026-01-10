<?php
require_once __DIR__ . "/../db.php";

class Customer
{

    private PDO $conn;


    public function __construct()
    {
        $db = new Db();
        $this->conn = $db->conn();
    }

    public function getAll()
    {

        $stmt = $this->conn->prepare("SELECT * FROM customers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function add(string $email, string $name, string $phone)
    {

        $stmt = $this->conn->prepare("INSERT INTO customers (name, email,phone) VALUES(?,?,?)");
        $added = $stmt->execute([$name, $email, $phone]);
        if ($added)
            return 200;
        else
            return 400;

    }

    public function delete(int $id)
    {
        $stmt = $this->conn->prepare("DELETE FROM customers WHERE id= ?");
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

        if (!empty($data['name'])) {
            $fields[] = "name = ?";
            $values[] = $data['name'];
        }

        if (!empty($data['email'])) {
            $fields[] = "email = ?";
            $values[] = $data['email'];
        }

        if (!empty($data['phone'])) {
            $fields[] = "phone = ?";
            $values[] = $data['phone'];
        }

        if (empty($fields)) {
            return 400;
        }

        $sql = "UPDATE customers SET " . implode(", ", $fields) . " WHERE id = ?";
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