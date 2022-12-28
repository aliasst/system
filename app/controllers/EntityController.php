<?php

namespace app\controllers;

use app\models\Category;
use app\models\Entity;

/** @property Entity $model */
class EntityController extends AppController
{

        public function legalViewAction ()
        {
            $entities = $this->model->findAll('legal');

            $title = "Список юридических лиц";
            $this->set(compact('entities', 'title'));
            $this->setMeta($title);
        }

        public function physicalViewAction ()
        {

            $entities = $this->model->findAll('physical');

            $title = "Список физических лиц";
            $this->set(compact('entities', 'title'));
            $this->setMeta($title);
        }

    public function addAction()
    {
        $type = get('type', 's');

        if(!empty($_POST)) {
            if(!empty($_POST['name'])) {
                if ($this->model->add($_POST['name'], $type)) {
                    $_SESSION['success'] = "Новое лицо добавлено";
                } else {
                    $_SESSION['errors'] = "Ошибка!";
                }
            } else {
                $_SESSION['errors'] = "Ошибка!";
            }
            redirect();
        }

        if($type == 'legal'){
            $title = "Добавить новое юридическое лицо";
        } else {
            $title = "Добавить новое физическое лицо";
        }

        $this->set(compact( 'title'));
        $this->setMeta($title);
    }


    public function viewexpensesAction()
    {
        $id = $this->route['id'];
        $expenses = [];
        $categoryname = '';
        $per = get('per', 's');
        $categorymodel = new Category();
        $categories = $categorymodel->findAll();

        if(!empty($_POST)) {

            $data = $_POST;
            $data['entity'] = $id;
            $data['period'] = $per;
            $categoryname = $categorymodel->findOne($data['category']);
            $categoryname = $categoryname[0]['name'];


            $expenses = $this->model->loadExpense($data);

            if(count($expenses)) {
                    $_SESSION['success'] = "Данные загружены!";
                } else {
                    $_SESSION['errors'] = "Ничего не найдено";

            }


        }

        $entity = $this->model->findOne($id);
        $entity = $entity[0];

        $title = "Смотреть расходы для - {$entity['name']}";
        $this->set(compact('entity','categories', 'title', 'per', 'expenses', 'categoryname'));
        $this->setMeta($title);
    }


        public function addexpensesAction()
        {
            $id = $this->route['id'];


            $per = get('per', 's');
            $categorymodel = new Category();
            $categories = $categorymodel->findAll();

            if(!empty($_POST)) {

                $data = $_POST;
                $data['week'] = isset($_POST['week']) ? $_POST['week'] : 0;
                $data['day'] = isset($_POST['day']) ? $_POST['day'] : 0;
                $data['entity'] = $id;
                $data['period'] = $per;
                //debug($data);
                //die();

                if(!empty($_POST['sum'])) {
                    if ($this->model->saveExpense($data)) {
                        $_SESSION['success'] = "Расход добавлен";
                    } else {
                        $_SESSION['errors'] = "Ошибка! Расход не добавлен";
                    }
                } else {
                    $_SESSION['errors'] = "Ошибка! Cумма расхода не заполненаe";
                }
                redirect();
            }



            $entity = $this->model->findOne($id);
            $entity = $entity[0];

            $title = "Добавить расход для - {$entity['name']}";
            $this->set(compact('entity','categories', 'title', 'per'));
            $this->setMeta($title);


        }

    public function deleteexpensesAction()
    {
        $id = $this->route['id'];
        if($this->model->deleteExpense($id)){
            $_SESSION['success'] = "Запись удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении записи";
        }
        redirect();


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