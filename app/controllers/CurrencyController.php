<?php

namespace app\controllers;

use app\models\Currency;

/** @property Category $model */
class CurrencyController extends AppController
{
        public function indexAction ()
        {
            $currencies = $this->model->findAll();
            $title = "Список валют";
            $this->set(compact('currencies', 'title'));
            $this->setMeta($title);

        }

    public function addAction()
    {
        if(!empty($_POST)) {

            if(!empty($_POST['name']) and !empty($_POST['short_name'])) {


                if ($this->model->add($_POST['name'], $_POST['short_name'])) {
                    $_SESSION['success'] = "Валюта добавлена";
                } else {
                    $_SESSION['errors'] = "Ошибка! Валюта не добавлена";
                }
            } else {
                $_SESSION['errors'] = "Ошибка! Валюта не добавлена";
            }
            redirect();
        }


        $title = "Добавить валюту";
        $this->set(compact( 'title'));
        $this->setMeta($title);
    }

    public function deleteAction()
    {
        $id = $this->route['id'];
        if($this->model->delete($id)){
            $_SESSION['success'] = "Валюта удалена успешно";
        } else {
            $_SESSION['errors'] = "Ошибка при удалении валюты";
        }
        redirect();


    }
}