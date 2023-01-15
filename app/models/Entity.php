<?php

namespace app\models;

class Entity extends AppModel
{
    public function findAll(string $type): array
    {
        $role = $_SESSION['user']['role'];
        $company_id = $_SESSION['user']['company_id'];

        if($role == 'superadmin') {
            return $this->db->query(
                'SELECT * FROM `entities` WHERE type = :type;',
                [':type' => $type]
            );
        } else {
            return $this->db->query(
                'SELECT * FROM `entities` WHERE type = :type AND id = :id;',
                [
                    ':type' => $type,
                    ':id' => $company_id,
                ]
            );
        }

    }

    public function findAllAll(): array
    {
        return $this->db->query(
            'SELECT * FROM `entities`');

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
            'INSERT INTO `expenses` (sum, entity_id, category_id, currency_id, year, month, week) VALUES (:sum, :entity, :category, :currency, :year, :month, :week)',
            [
                ':sum' => $data['sum'],
                ':entity' => $data['entity'],
                ':category' => $data['category'],
                ':currency' => $data['currency'],
                ':year' => $data['year'],
                ':month' => $data['month'],
                ':week' => $data['week'],
            ]
        );

    }

    public function loadExpense($data)
    {
        //debug($data);
        $sqlpart = 'WHERE e.entity_id = :entity_id AND e.year = :year';
        $paramspart = [':entity_id' => $data['entity'], ':year' => $data['year']];

        if($data['category'] != 1){
            $sqlpart .= ' AND e.category_id = :category_id';
            $paramspart[':category_id'] = $data['category'];
        }


        $sqlpart .= ' AND e.month = :month';
        $paramspart[':month'] = $data['month'];

        if($data['week'] != 6) {
            $sqlpart .= ' AND e.week = :week';
            $paramspart[':week'] = $data['week'];
        }


        //debug($sqlpart);
        //debug($paramspart);

        $expenses = $this->db->query(
            "SELECT e.*, c.name, cr.short_name, w.week_name, m.month_name  FROM `expenses` e 
            JOIN `categories` c ON c.id = e.category_id 
            JOIN `currency` cr ON cr.id = e.currency_id
            JOIN `weeks` w ON w.id = e.week
            JOIN `months` m ON m.id = e.month
            $sqlpart",
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