<?php

namespace app\models;

class Category extends AppModel
{
    public function findAll(int $type = 1): array
    {
        return $this->db->query(
            'SELECT * FROM `categories` WHERE type = :type;',
            [':type' => $type]
        );
    }

    public function findOne(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM `categories` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function delete(int $id): bool
    {
        return $this->db->delete(
            'DELETE FROM `categories` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function add(string $name, int $type = 1): bool
    {
        return $this->db->save(
            'INSERT INTO `categories` (name, type) VALUES (:name, :type)',
            [
                ':name' => $name,
                ':type' => $type,
            ]
        );

    }

}