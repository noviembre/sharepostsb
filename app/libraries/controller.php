<?php
  /*
   * Base Controller
   * Carga los models y los views
   */
  class Controller {
    // Load models
    public function model($model){
      // Require models file
      require_once '../app/models/' . $model . '.php';

      // Instatiate models
      return new $model();
    }

    // Load view
    // $data = [], representa los valores dinamicos q le pasaremos a las vistas
    public function view($view, $data = []){
      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
  }