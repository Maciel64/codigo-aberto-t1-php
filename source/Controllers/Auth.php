<?php

    namespace Source\Controllers;

    use Source\Models\User;

    class Auth extends Controller {

        public function __construct($router) {
            parent::__construct($router);
        }


        public function login($data): void {
            echo json_encode($data);
        }


        public function register($data): void {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            if (in_array("", $data)) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Não deixe os campos vazios"
                ]);

                return;
            }

            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Por favor, informe um email válido"
                ]);

                return;
            }

            $userEmailExists = (new User)->find("email = :e", "e={$data["email"]}")->count();

            if ($userEmailExists) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Email passado já está cadastrado"
                ]);

                return;
            }

            $user = new User();
            $user->first_name = $data["first_name"];
            $user->last_name = $data["last_name"];
            $user->email = $data["email"];
            $user->passwd = password_hash($data["passwd"], PASSWORD_DEFAULT);

            $user->save();
            $_SESSION["user"] = $user->id;

            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("app.home")
            ]);
        }
    }