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

 // Notice Post Query
 $result = $post->read();
//Get Row Count
$num = $result->rowCount();

//check if any notice
if($num >0){
    //Post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'notice'=>$notice,
            'dept'=>$dept,
            'year' =>$year,
            'postby'=>$postby,
            'datetime'=>$datetime
        );

        // Push to "data"
        array_push($posts_arr['data'],$post_item);

    }
     // Turn into JSON
     echo json_encode($posts_arr);
}else {
    echo json_encode(
        array('message' => 'No Notice Found')
    );
}

