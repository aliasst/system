<?php

namespace app\controllers;

use app\models\Category;

/** @property Category $model */
class CategoryController extends AppController
{
        public function indexAction ()
        {
            $categories_1 = $this->model->findAll(1);
            $categories_2 = $this->model->findAll(2);
            $title = "Список всех категорий";
            $this->set(compact('categories_1', 'categories_2', 'title'));
            $this->setMeta($title);

        }

    public function addAction()
    {
        if(!empty($_POST)) {

            if(!empty($_POST['name'])) {
            $type = get('type');


                if ($this->model->add($_POST['name'], $type)) {
                    $_SESSION['success'] = "Категория добавлена";
                } else {
                    $_SESSION['errors'] = "Ошибка! Категория не добавлена";
                }
            } else {
                $_SESSION['errors'] = "Ошибка! Категория не добавлена";
            }
            redirect();
        }




        $title = "Добавить категорию";
        $this->set(compact( 'title'));
        $this->setMeta($title);
    }

    public function deleteAction()
    {
        $id = $this->route['id'];
        if($this->model->delete($id)){
            $_SESSION['success'] = "Категория удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении категории";
        }
        redirect();


    }
}