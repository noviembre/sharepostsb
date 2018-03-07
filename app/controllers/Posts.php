<?php
/**
 * Created by PhpStorm.
 * User: GoMiNam
 * Date: 3/7/2018
 * Time: 11:32 AM
 * POST 1/
 */
class Posts extends Controller {

    public function __construct(){
        //si no ha iniciado sesion redirigir a login
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
    }
    public function index(){
        // llamar al modelo
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }
}