<?php

    namespace Source\Models;

    use CoffeeCode\DataLayer\DataLayer;
use Exception;

class User extends DataLayer {
        public function __construct() {
            parent::__construct("users", ["first_name", "last_name", "email", "passwd"]);
        }


        public function save() : bool {
            return $this->validateEmail() && $this->validatePassword() && parent::save();
        }


        protected function validateEmail() : bool {
            if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->fail = new Exception("Informe um email válido");
                return false;
            }


            $userByEmail = null;

            if (!$this->id) {
                $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
            
            } else {
                $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
            }

            return true;
        }


        protected function validatePassword () : bool {

            if (empty($this->passwd) || strlen($this->passwd) < 5) {
                $this->fail = new Exception("Digite uma senha válida");
                return false;
            }


            if (password_get_info($this->passwd)["algo"]) {
                return true;
            }

            $this->passwd = password_hash($this->passwd, PASSWORD_DEFAULT);
            return true;
        }
    }