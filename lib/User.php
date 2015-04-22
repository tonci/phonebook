<?php

namespace lib;

class User {

    public function __construct()
    {
        session_set_cookie_params(3600, '/', $_SERVER['SERVER_NAME'], App::isSSL(), true);
        session_start();
    }

    public function login(\models\User $user)
    {
        $_SESSION['user'] = $user;
        return true;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function isGuest()
    {
        return empty($_SESSION['user']);
    }

    public function getId()
    {
        return $_SESSION['user']->id;
    }

    public function getUsername()
    {
        return $_SESSION['user']->username;
    }

}