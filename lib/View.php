<?php

namespace lib;

class View {

    function render($view, $params = []){
        if (is_file($view)){
            if (!empty($params)){
                extract($params, EXTR_SKIP);
            }
            ob_start();
            $errReporting = error_reporting(E_ALL ^ E_NOTICE);
            include($view);
            error_reporting($errReporting);
            $content = ob_get_clean();
            return $content;
        } else {
            return "<br />view not found: ".$view;
        }
    }
}