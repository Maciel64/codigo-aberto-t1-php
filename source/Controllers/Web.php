<?php

    namespace Source\Controllers;

    use stdClass;

    class Web extends Controller {

        /**
         * @param $router
         */

        public function __construct($router) {
            parent::__construct($router);

            // if (!empty($_SESSION["user"])) {
            //     $this->router->redirect("app.home");
            // }
        }


        public function login () : void {
           $head = $this->seo->optimize(
               "Faça Login | " . site("name"),
               site("desc"),
               $this->router->route("web.login"),
               routeImage("Login")
           )->render();

           echo $this->view->render("theme/login", [
               "head" => $head
           ]);

        }


        public function register () : void {
            $head = $this->seo->optimize(
                "Crie sua conta no " . site("name"),
                site("desc"),
                $this->router->route("web.register"),
                routeImage("Register")
            )->render();
 
            $form_user = new \stdClass;
            $form_user->first_name = "Maciel";
            $form_user->last_name = "Suassuna";
            $form_user->email = "maciel@gmail.com";

            echo $this->view->render("theme/register", [
                "head" => $head,
                "user" => $form_user
            ]);
        }


        public function forget () : void {
            $head = $this->seo->optimize(
                "Recupere sua senha | " . site("name"),
                site("desc"),
                $this->router->route("web.forget"),
                routeImage("Forget")
            )->render();
 

            echo $this->view->render("theme/forget", [
                "head" => $head
            ]);
        }


        public function reset (array $data) : void {
            $head = $this->seo->optimize(
                "Crie sua nova senha | " . site("name"),
                site("desc"),
                $this->router->route("web.reset"),
                routeImage("Password reset")
            )->render();
 

            echo $this->view->render("theme/reset", [
                "head" => $head
            ]);
        }



        public function error (array $data) : void {
            $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);

            $head = $this->seo->optimize(
                "Ops, um {$error} erro ocorreu... | " . site("name"),
                site("desc"),
                $this->router->route("web.error", ["errcode" => $error]),
                routeImage("Error {$error}")
            )->render();
 

            echo $this->view->render("theme/error", [
                "head" => $head,
                "error" => $error
            ]);
        }
    }