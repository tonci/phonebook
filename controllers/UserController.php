<?php

namespace controllers;

use models\LoginForm;
use models\RegisterForm;
use models\PasswordChangeForm;
use lib\App;
use models\User;

class UserController extends \lib\Controller {
    public function actionIndex()
    {
        return $this->render('index', ['param'=>'test']);
    }

    public function actionLogin($params = '')
    {
        $model = new LoginForm;
        $params['model'] = $model;

        if (isset($_POST['LoginForm'])) {
            $model->username = $_POST['LoginForm']['username'];
            $model->password = $_POST['LoginForm']['password'];
            if ($model->login()) {
                $this->redirect('contacts');
            }
        }

        $this->layout = 'login';
        return $this->render('login', $params);
    }

    public function actionRegister()
    {
        $this->layout = 'login';
        $model = new RegisterForm;
        $params['model'] = $model;

        if (isset($_POST['RegisterForm'])) {
            $model->username = $_POST['RegisterForm']['username'];
            $model->password = $_POST['RegisterForm']['password'];
            $model->password_repeat = $_POST['RegisterForm']['password_repeat'];
            if($model->register()){
                App::getComponent('user')->login((new User)->findByUsername($model->username)[0]);
                $this->redirect('contacts');
            }
        }

        return $this->render('register', $params);
    }

    public function actionPasswordChange()
    {
        $model = new PasswordChangeForm;
        $params['model'] = $model;

        if (isset($_POST['PasswordChangeForm'])) {
            $model->password = $_POST['PasswordChangeForm']['password'];
            $model->new_password = $_POST['PasswordChangeForm']['new_password'];
            if ($model->change()) {
                $params['success'] = true;
                $model->password = '';
                $model->new_password = '';
            }
        }
        return $this->render('password_change', $params);
    }

    public function actionLogout()
    {
        App::getComponent('user')->logout();
        $this->redirect('user', 'login');
    }

}