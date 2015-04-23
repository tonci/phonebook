<?php

namespace controllers;

class ErrorController extends \lib\Controller {
    public function action404()
    {
        return $this->renderPartial('404');
    }
}