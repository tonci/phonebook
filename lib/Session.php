<?php

namespace lib;

class Session {

    public function __construct()
    {
        session_set_cookie_params(60*60*24, '/', $_SERVER['SERVER_NAME'], App::isSSL(), true);
        session_start();
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return $_SESSION[$name];
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
    }

}