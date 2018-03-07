<?php
/**
 * Created by PhpStorm.
 * User: GoMiNam
 * Date: 3/7/2018
 * Time: 12:04 PM
 * 3/
 */

  class Post {
      private $db;

      public function __construct(){
          $this->db = new Database;
      }

      public function getPosts(){
          $this->db->query('SELECT *,
                        posts.id as postId,
                        users.id as userId,
                        posts.created_at as postCreated,
                        users.created_at as userCreated
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY posts.created_at DESC
                        ');

          $results = $this->db->resultSet();

          return $results;
      }

  }