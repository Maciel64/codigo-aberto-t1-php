<?php

    namespace Source\Controllers;

    use CoffeeCode\Optimizer\Optimizer;
    use CoffeeCode\Router\Router;
    use League\Plates\Engine;

    /**
     * Class Controller
     * @package Source\Controllers
     */

    abstract class Controller {

        /** @var Router */
        protected $view;
        
        /** @var Engine */
        protected $router;
        
        /** @var Optimizer */
        protected $seo;


        /**
         * Controller constructor.
         * @param $router
         */

        public function __construct ($router) {

            $this->router = $router;
            $this->view = Engine::create(dirname(__DIR__, 2) . "/views", "php");
            $this->view->addData(["router" => $this->router]);

            $this->seo = new Optimizer();
            $this->seo->openGraph(site("name"), site("locale"), "article");
        }

        /**
         * @param string $param
         * @param array $values
         * @return string
         */

        public function ajaxResponse (string $param, array $values) : string {
            return json_encode([$param => $values]);
        }
    }

?>