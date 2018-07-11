<?php
 // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');  //Setting DELETE Request for DELETE
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

 // Set ID to Upate
 $post->id = $data->id;


 // Delte Post
 if($post->delete()){
     echo json_encode(
         array('messgae' => 'Sucessfully Deleted')
     );
 }else{
    echo json_encode(
        array('messgae' => 'Post Not Deleted')
    );
 }
