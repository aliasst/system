<?php

namespace app\models;

class Category extends AppModel
{
    public function findAll(): array
    {
        return $this->db->query(
            'SELECT * FROM `categories`;'
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

    public function add(string $name): bool
    {
        return $this->db->save(
            'INSERT INTO `categories` (name) VALUES (:name)',
            [':name' => $name]
        );

    }

}