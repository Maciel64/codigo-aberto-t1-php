<?php
    /**
     * Configurações do site
     */

    define("SITE", [
        "name" => "Autenticação em MVC com PHP",
        "desc" => "Aprendendo a construir uma autenticação em PHP seguindo boas práticas",
        "domain" => "localauth.com",
        "locale" => "pt_BR",
        "root" => "http://localhost/robson-v-leite-codigo-aberto-1/"
    ]);

    /**
     * Minify do site
     */

    if ($_SERVER["SERVER_NAME"] === "localhost") {
        require __DIR__ . "/Minify.php";
    }

    /**
     * Configurações do banco de dados
     */

    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => "localhost",
        "port" => "3306",
        "dbname" => "auth-codigo-aberto-t1",
        "username" => "root",
        "passwd" => "Maciel64!",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);

    /**
     * SOCIAL
     */

    define("SOCIAL", []);

    /**
     * Mail
     */

    define("MAIL", []);

    /**
     * SOCIAL: FACEBOOK LOGIN
     */

    define("FACEBOOK_LOGIN", []);

    /**
     * SOCIAL: GOOGLE_LOGIN
     */

    define("GOOGLE_LOGIN", []);