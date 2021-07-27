<?php

namespace App\Controller;

use Core\AbstractController;

class User extends AbstractController
{

    public function loginAction()
    {
        echo __METHOD__;
    }

    public function registerAction()
    {
        $user = new \App\Model\User();
        return $this->view->render('User/register.phtml', [
            "userName" => "Ilnar",
            "user" => $user
        ]);
    }
}