<?php
 // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

 // Instantiate Notice Post
 $post = new Post($db);

 // Get the id form url
 $post->id = isset($_GET['id']) ? $_GET['id'] : die();

 //Get Post 
 $post->read_single();

//create array
$post_arr = array(
 'id' => $post->id,
 'notice' => $post->notice,
  'dept'  => $post->dept,
  'year'  => $post->year,
  'postby'=> $post->postby,
  'datetime'=>$post->datetime
);

// Make JSON
print_r(json_encode($post_arr));