<?php

namespace app\models;

class User extends AppModel
{

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin(): bool
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] = 'admin');
    }

    public function login($is_admin = false) :bool
    {
        $email = post('email');
        $password = post('password');
        if($email && $password) {
            if($is_admin){
                $user = $this->db->query(
                    'SELECT * FROM `user` WHERE role = :role AND email = :email;',
                    [':role' => 'admin', ':email' => $email]
                );
                logger($user[0]['password']);


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
}