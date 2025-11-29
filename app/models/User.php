<?php

class User
{
    private $db;

    public function __construct()
    {
        // Use the singleton
        $this->db = Database::getInstance()->getConnection();
    }


    /* CREATE USER */
    public function createUser($name, $email, $age)
    {
        $sql = "INSERT INTO users (name, email, age) 
                VALUES (:name, :email, :age)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":name"  => $name,
            ":email" => $email,
            ":age"   => $age
        ]);
    }

    /* GET ONE USER */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* GET ALL USERS */
    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* UPDATE USER */
    public function updateUser($id, $name, $email, $age)
    {
        $sql = "UPDATE users 
                SET name = :name, email = :email, age = :age 
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":id"    => $id,
            ":name"  => $name,
            ":email" => $email,
            ":age"   => $age
        ]);
    }

    /* DELETE USER */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([":id" => $id]);
    }
}
