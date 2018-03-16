<?php
/**
 * Created by PhpStorm.
 * User: GoMiNam
 * Date: 3/6/2018
 * Time: 10:15 AM
 */
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Registrar a un Usuario
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Contar
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($email, $password){

        $this->db->query("SELECT * FROM users WHERE email = :email");

        $this->db->bind(":email", $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){
            //devolver la fila del usuario
            return $row;
        } else {
            return false;
        }
    }

    // Get User by ID
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }


}