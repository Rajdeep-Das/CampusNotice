<?php
 // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

 // Instantiate Notice Post
 $post = new Post($db);

 //Get raw posted data
 $data = json_decode(file_get_contents("php://input"));

 $post->notice = $data->notice;
 $post->dept = $data->dept;
 $post->year = $data->year;
 $post->postby = $data->postby;

 // Create Post
 if($post->create()){
     echo json_encode(
         array('messgae' => 'Sucessfully Post')
     );
 }else{
    echo json_encode(
        array('messgae' => 'Post Not Created')
    );
 }
