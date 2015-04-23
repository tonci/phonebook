<?php

namespace lib;

class User {

    private $session;

    public function __construct()
    {
        $this->session = App::getComponent('session');
    }

    public function login(\models\User $user)
    {
        $this->session->set('user', $user);

        return true;
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function isGuest()
    {
        return (boolean)$this->session->get('user');
    }

    public function getId()
    {
        return $this->session->get('user')->id;
    }

    public function getUsername()
    {
        return $this->session->get('user')->username;
    }

}