<?php

namespace app\controllers;

use app\models\Entity;

class UserController extends AppController
{

    public function addAction()
    {

        if(!empty($_POST)) {
            if (!empty($_POST['login']) & !empty($_POST['password'])) {

                $data = $_POST;
                echo($data['login']);

                if ($this->model->checkUnique($data['login'])) {


                    if ($this->model->add($data)) {
                        $_SESSION['success'] = "Пользователь добавлен";
                    } else {
                        $_SESSION['errors'] = "Ошибка! Пользователь не добавлен";
                    }


                } else {
                    $_SESSION['errors'] = "Ошибка! Такой пользователь уже существует";
                }


                redirect();
            } else {
                $_SESSION['errors'] = "Ошибка! Заполните обязательные поля";
                redirect();
            }
        }

        $title = "Добавить пользователя";
        $this->set(compact( 'title'));
        $this->setMeta($title);
    }


    public function editAction()
    {
        $id = $this->route['id'];
        $user = $this->model->findOne($id);
        $entity = new Entity();
        $entities = $entity->findAllAll();


        if (empty($user)){
            $this->error_404();
            return;
        }
        $user = $user[0];
        $data = $_POST;
        $data['id'] = $id;
        $data['name'] = $user['name'];


        if(!empty($_POST['password'])) {

            if ($this->model->edit($data)) {
                $_SESSION['success'] = "Пользователь изменен";
            } else {
                $_SESSION['errors'] = "Ошибка! Пользователь не изменен";
            }
            redirect();

        }



        $title = "Редактировать пользователя '{$user['name']}'";
        $this->set(compact( 'title', 'user', 'entities'));
        $this->setMeta($title);
    }




    public function indexAction()
    {
        $users = $this->model->findAll();
        $this->setMeta("Список пользователей");
        $this->set(compact('users'));

    }




    public function loginAdminAction()
    {
        if ($this->model::isAdmin()) {
            redirect(PATH);
        }

        $this->layout = 'login';
        if (!empty($_POST)) {
            if ($this->model->login(true)) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
            } else {
                $_SESSION['errors'] = 'Логин/пароль введены неверно';
            }
            if ($this->model::isAdmin()) {
                redirect(PATH);
            } else {
                redirect();
            }
        }

    }

    public function logoutAction()
    {
        if ($this->model::isAdmin()) {
            unset($_SESSION['user']);
        }
        redirect(PATH . '/user/login-admin');
    }


    public function deleteAction()
    {
        $id = $this->route['id'];
        if($this->model->delete($id)){
            $_SESSION['success'] = "Пользователь удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении пользователя";
        }
        redirect();


    }


}