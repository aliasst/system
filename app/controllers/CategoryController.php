<?php

namespace app\controllers;

use app\models\Category;

/** @property Category $model */
class CategoryController extends AppController
{
        public function indexAction ()
        {
            $categories = $this->model->findAll();
            unset($categories[0]);
            $title = "Список всех категорий";
            $this->set(compact('categories', 'title'));
            $this->setMeta($title);

        }

    public function addAction()
    {
        if(!empty($_POST)) {

            if(!empty($_POST['name'])) {



                if ($this->model->add($_POST['name'])) {
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
            $_SESSION['success'] = "Страница удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении страницы";
        }
        redirect();


    }
}