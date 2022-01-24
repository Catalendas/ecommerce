<?php

    namespace Hcode;

    use Rain\Tpl;

    class Page {

        private $tpl;
        private $opitions = [];
        private $defaults = [
            "header"=>true,
            "footer"=>true,
            "data"=>[]
        ];


        // e executados assim que a classe da pagina e iniciada
        // responsavel por renderizar o header
        public function __construct($opts = array(), $tpl_dir = "/views/"){

            $this->options = array_merge($this->defaults, $opts);

            $config = array(
                "base_url"      => null,
                "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
                "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/"
               );

               Tpl::configure($config);

               $this->tpl = new Tpl;

               $this->setData($this->options["data"]);

              if ($this->options["header"] === true ) $this->tpl->draw("header");

    
        }

        // Define as variaveis informadas em nosso template
        private function setData($data = array()) {

            foreach($data as $key => $value) {
                $this->tpl->assign($key, $value);
            }

        }

        // Esse metodo espera tres parametros
        // 1)$name - e o nome do arquivo HTML que queremos renderizar
        // 2)$data - e um array, onde recebemos os dados ou variaveis que queremos mostrar na pagina
        // 3)$returnHTML - e um booleano, que define se o HTML vai ser escrito ou interpretado
        public function setTpl($name, $data = array(), $returHTML = false ) {

            $this->setData($data);

            $this->tpl->draw($name, $returHTML);

        }

        // e executados assim que a classe da pagina e iniciada
        // Responsavel por renderizar o footer(roda pe)
        public function __destruct(){

           if ($this->options["footer"] === true ) $this->tpl->draw("footer");

        }
    }