<?php
  class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');

    }

    public function register(){
      // Check for POST
      //si el metdo es = a POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
          //die("sumitted");
          // Init data
          // estos campos deben ser llenados
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

          // Validate Email
          if(empty($data['email'])){
              $data['email_err'] = 'Pleae enter email';
          } else {
              // buscar si ya existe el email
              if($this->userModel->findUserByEmail($data['email'])){
                  $data['email_err'] = 'Email is already taken';
              }
          }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }
          
          // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated

            // Encriptar pass. Hash Password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            // Si se logra regsitrar vaya a...
            if($this->userModel->register($data)){
                flash('register_success', 'You are registered and can log in');
                redirect('users/login');
            } else {
                die('Something went wrong');
            }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }
          
      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
          //que enviaremos
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          die('SUCCESS');
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }
  }