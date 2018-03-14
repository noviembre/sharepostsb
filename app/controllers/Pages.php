<?php 
#podemos acceder a Controller desde aqui
class Pages extends Controller {
	public function __construct(){		
		
	}
	//b. llamar al modelo de la funcion
	public function index(){

	    if(isLoggedIn()){
	        redirect('posts');
        }
		
      
      $data = [
        'title' => 'Shareposts',
<<<<<<< HEAD
        'description' => 'PHP MVC Framework Mi pagina wec',
=======
        'description' => 'bienvenido a mi Red Social MVC PHP Framework',
>>>>>>> caracteristica/nueva
        
      ];
     //d. y lo pasamos a la Vista
        $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'about of the PHP Framework'
      ];

      $this->view('pages/about', $data);
    }
}