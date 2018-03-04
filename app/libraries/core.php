<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //imprima o muestre el array
        //print_r( $this->getUrl());
        $url = $this->getUrl();
        // Look in controllers for first value
        //si traversimvc/post existe que lo convierta en un controller
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url['0']);
            //
            unset($url['0']);            
        }
        //llamar al controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        //instancia controller class
        $this->currentController = new $this->currentController;

        //check for second part of URL
        if(isset($url['1'])){
            //comprobar si el metodo existe
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //unset 1 index
                unset($url[1]);

            }
        }
        //Get Params (si hay parametros los agregara) o de lo contrario sera un array vacio
        $this->params = $url ? array_values($url) : [];
        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        //
        if(isset($_GET['url'])){ 
            // rtrim, agregar un / a la url
            $url = rtrim($_GET['url'], '/'); 
            //filter_var,filtrar las variables( la url no aceptara ningun caracter que no deberia permitir)
            $url = filter_var($url, FILTER_SANITIZE_URL); 
            // explode, te permite multiples varibles ejem: post/edit/1
            $url = explode('/',$url); 
            return $url; 
        }
    }
      
      
  }
