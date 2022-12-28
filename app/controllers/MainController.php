<?php

namespace app\controllers;

use app\models\Entity;
use core\Controller;

class MainController extends AppController
{
    public function indexAction()
    {
        $entitymodel = new Entity();
        $legal = count($entitymodel->findAll('legal'));
        $physical = count($entitymodel->findAll('physical'));

        $this->set(compact('legal', 'physical'));
        $this->setMeta('Главная');


    }
}