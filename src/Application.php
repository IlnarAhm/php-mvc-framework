<?php


namespace Core;


use App\Controller\User;

class Application
{
    private $route;
    /** @var AbstractController */
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        $this->addRoutes();
        try {
            $this->initController();
        } catch (\Exception $e) {
        }
        try {
            $this->initAction();
        } catch (\Exception $e) {
        }

        $this->controller->{$this->actionName}();
    }

    private function addRoutes()
    {
        /** @uses \App\Controller\User::loginAction() */
        $this->route->addRoute('/user/login', User::class, 'login');
        /** @uses \App\Controller\User::registerAction() */
        $this->route->addRoute('/user/register', User::class, 'register');
    }

    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) {
            throw new \Exception('Cant find controller ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new \Exception('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }
}