<?php

namespace app\models;

class User extends AppModel
{


    public function findAll(): array
    {
        return $this->db->query(
            'SELECT * FROM `user`'
        );
    }

    public function findOne(int $id): array
    {
        return $this->db->query(
            'SELECT * FROM `user` WHERE id = :id;',
            [':id' => $id]
        );

    }

    public function add($data): bool
    {

        return $this->db->save(
            'INSERT INTO `user` (name, password, role) VALUES (:name, :password, :role)',
            [
                ':name' => $data['login'],
                ':password' => $data['password'],
                ':role' => $data['role']
            ]
        );


    }


    public function edit($data): bool
    {

        return $this->db->save(
            'UPDATE `user` SET password = ?, role = ?, company_id = ? WHERE id = ?',
            [
                $data['password'],
                $data['role'],
                $data['company_id'],
                $data['id']
            ]
        );


    }



    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin(): bool
    {
        return (isset($_SESSION['user']));
    }

    public function login($is_admin = false) :bool
    {
        $login = post('login');
        $password = post('password');
        if($login && $password) {
            if($is_admin){
                $user = $this->db->query(
                    'SELECT * FROM `user` WHERE name = :name;',
                    [':name' => $login]
                );
                if($user){
                    logger($user[0]['password']);
                }



            } else {
                /*$user = R::findOne('user', "email = ?", [$email]);*/
            }

            if($user){
                if($password == $user[0]['password']){
                    foreach($user[0] as $k => $v){
                        if($k != 'password') {
                            $_SESSION['user'][$k] = $v;

                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }



    public function delete(int $id): bool
    {
        return $this->db->delete(
            'DELETE FROM `user` WHERE id = :id;',
            [':id' => $id]
        );

    }


    public function checkUnique(string $login): bool
    {
        $result =  $this->db->query(
            'SELECT * FROM `user` WHERE name = :login;',
            [':login' => $login]
        );

        if(!empty($result)){
            return false;
        }

        return true;

    }

    public static function checkRight(): bool
    {



    }

}