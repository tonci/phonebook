<?php

namespace controllers;

class UserController extends \lib\Controller {
    public function actionIndex()
    {
        return $this->render('index', ['param'=>'test']);
    }

    public function actionTest($params = '')
    {
        print_r($params);
        echo 'test';
    }
}