<?php

namespace lib;

class Session {

    public function __construct()
    {
        // if tested locally $_SERVER['SERVER_NAME'] will most probably give "localhost" wich results in a problem setting the cookie in chrome
        // so I leave it NULL
        session_set_cookie_params(60*60*24, '/', NULL /*$_SERVER['SERVER_NAME']*/, (bool)App::isSSL(), true);
        session_start();
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return @$_SESSION[$name];
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
    }

}