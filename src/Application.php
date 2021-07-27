<?php

namespace Core;

use App\Controller\User;
use Core\RedirectException;

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
        try {
            $this->addRoutes();
            $this->initController();
            $this->initAction();

            $view = new View();
            $this->controller->setView($view);

            $content = $this->controller->{$this->actionName}();

            echo $content;
        } catch (RedirectException $e) {
            header("Location: {$e->getUrl()}");
            die;
        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage();
        }
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
            throw new RouteException('Cant find controller ' . $controllerName);
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