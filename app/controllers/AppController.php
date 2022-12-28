<?php

namespace app\controllers;

use app\models\User;
use app\models\AppModel;
use core\App;
use core\Controller;

class AppController extends Controller
{


    public function __construct($route = [])
    {
        parent::__construct($route);


        if (!User::isAdmin() && $route['action'] != 'login-admin') {
            redirect(PATH . '/user/login-admin');
        }


    }

}