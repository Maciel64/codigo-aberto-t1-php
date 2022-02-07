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

    function asset (string $path, bool $time = true) : string {

        $file = site() . "views/assets{$path}";
        $fileOndir = dirname(__DIR__, 1) . "views/assets/{$path}";

        if ($time && file_exists($fileOndir)) {
            $file .= "?time=" . filemtime($fileOndir);
        }

        return $file;
    }


    /**
     * @param string $type Chave de descrição do erro
     * @param string $message Mensagem para determinado erro
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


    function routeImage (string $imageUrl) : string {
        return "https://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
    }