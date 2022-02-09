<?php

    namespace Source\Controllers;

    use Source\Models\User;

    class Auth extends Controller {

        public function __construct($router) {
            parent::__construct($router);
        }


        public function login(array $data) : void {
            $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($data["passwd"], FILTER_DEFAULT);

            if (!$email || !$passwd) {
                echo $this->ajaxResponse("message", [
                    "type" => "alert",
                    "message" => "Informe seu email e senha para logar-se"
                ]);
                return;
            }


            $user = (new User)->find("email = :e", "e={$email}")->fetch();
            if (!$user || !password_verify($passwd, $user->passwd)) {
                echo $this->ajaxResponse("message", [
                    "type" => "success",
                    "message" => "Email ou senha inválidos"
                ]);
                return; 
            }


            $_SESSION["user"] = $user->id;


            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("app.home")
            ]);
        }


        public function register($data) : void {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            if (in_array("", $data)) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Não deixe os campos vazios"
                ]);

                return;
            }


            $user = new User();
            $user->first_name = $data["first_name"];
            $user->last_name = $data["last_name"];
            $user->email = $data["email"];
            $user->passwd = $data["passwd"];

            
            if (!$user->save()) {
                
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $user->fail()->getMessage()
                ]);

                return;
            }


            $_SESSION["user"] = $user->id;

            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("app.home")
            ]);
        }
    }