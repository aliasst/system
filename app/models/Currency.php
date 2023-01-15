<?php

namespace app\models;

class Currency extends AppModel
{
    public function findAll(): array
    {
        return $this->db->query(
            'SELECT * FROM `currency`;'
        );
    }

    public function findOne(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM `currency` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function delete(int $id): bool
    {
        return $this->db->delete(
            'DELETE FROM `currency` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function add(string $name, $short_name = 'test'): bool
    {
        return $this->db->save(
            'INSERT INTO `currency` (name, short_name) VALUES (:name, :short_name)',
            [
                ':name' => $name,
                ':short_name' => $short_name,
            ]
        );

    }

}