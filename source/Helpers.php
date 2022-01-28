<?php

    /**
     * @param string|null $param Dado a ser pego da constante SITE
     * @return string Dado acessado
     */
    
    function site (string $param = null) : string {
        
        if ($param && !empty(SITE[$param])) {
            return SITE[$param];
        }

        return SITE["root"];
    }

    /**
     * @param string $path Caminho para o asset a ser acessado
     * @return string Asset encontrado no caminho passado
     */

    function asset (string $path) : string {
        return SITE["root"] . "/views/assets/{$path}";
    }


    /**
     * 
     */

    function flash (string $type = null, string $message = null) : ?string {

        if ($type && $message) {
            
            $_SESSION["flash"] = [
                "type" => $type,
                "message" => $message
            ];
            
            return null;
        }


        if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"] ) {
            unset($_SESSION["flash"]);

            return "<div class=\"message {$flash["type"]}\">{$flash["message"]}</div>";
        }

        
        return null;
    }