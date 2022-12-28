<?php

namespace app\models;

class Entity extends AppModel
{
    public function findAll(string $type): array
    {
        return $this->db->query(
            'SELECT * FROM `entities` WHERE type = :type;',
            [':type' => $type]
        );

    }

    public function findOne(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM `entities` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function add(string $name, string $type): bool
    {

        //die();
        return $this->db->save(
            'INSERT INTO `entities` (name, type) VALUES (:name, :type)',
            [':name' => $name, ':type' => $type]
        );


    }

    public function delete(int $id): bool
    {
        return $this->db->delete(
            'DELETE FROM `entities` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function saveExpense($data): bool
    {
        return $this->db->save(
            'INSERT INTO `expenses` (sum, entity_id, category_id, period, year, month, week, day) VALUES (:sum, :entity, :category, :period, :year, :month, :week, :day)',
            [
                ':sum' => $data['sum'],
                ':entity' => $data['entity'],
                ':category' => $data['category'],
                ':period' => $data['period'],
                ':year' => $data['year'],
                ':month' => $data['month'],
                ':week' => $data['week'],
                ':day' => $data['day'],
            ]
        );

    }

    public function loadExpense($data)
    {
        //debug($data);
        $sqlpart = 'WHERE entity_id = :entity_id AND category_id = :category_id AND year = :year';
        $paramspart = [':entity_id' => $data['entity'], ':category_id' => $data['category'], ':year' => $data['year']];

        $sqlpart .= ' AND month = :month';
        $paramspart[':month'] = $data['month'];

        $sqlpart .= ' AND period = :period';
        $paramspart[':period'] = $data['period'];

        if($data['period'] = 'week' && isset($data['week'])){
            $sqlpart .= ' AND week = :week';
            $paramspart[':week'] = $data['week'];
        }

        if($data['period'] = 'day' && isset($data['day'])){
            $sqlpart .= ' AND day = :day';
            $paramspart[':day'] = $data['day'];
        }

        //debug($sqlpart);
        //debug($paramspart);

        $expenses = $this->db->query(
            "SELECT * FROM `expenses` $sqlpart;",
            $paramspart
        );

        return $expenses;

    }

    public function deleteExpense(int $id): bool
    {
        return $this->db->delete(
            'DELETE FROM `expenses` WHERE id = :id;',
            [':id' => $id]
        );

    }



}