<?php

    ob_start();
    session_start();

    require __DIR__ . "/vendor/autoload.php";

    echo "Olá, mundo";

    ob_end_flush();