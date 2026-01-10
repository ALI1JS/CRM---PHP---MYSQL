<?php
session_start();
require_once "../db.php";

class Auth
{

    private PDO $conn;

    public function __construct()
    {
        $db = new Db();
        $this->conn = $db->conn();
    }

    public function login(string $email, string $password)
    {

        $error = null;

        if (!$this->validate($email, $password)) {
            $error = "Email And Password Required";
        }

        $user = $this->findUser($email);
        if (!$user) {
            $error = "Invalid email or password";

        } elseif (!password_verify($password, $user['password'])) {

            $error = "Invalid email or password";

        } else {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header("Location: /crm/public/customer/customer.php");
            exit;
        }

        if ($error) {
            $_SESSION["error"] = $error;
            header("Location: /crm/public/auth/login.php");
            exit;

        }
    }

    public function validate(string $email, string $password)
    {

        return !empty($email) && !empty($password);
    }

    public function findUser(string $email)
    {
        $stmt = $this->conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function logout () {

       session_unset();
       session_destroy();

       header("Location: /crm/public/auth/login.php");
       exit;
    }


}