<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $post = new Post($db);

  // get id
  $post->id = isset($_GET['id']) ? $_GET['id'] : die('');

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => html_entity_decode($post->body),
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
  );
  
  // Make Json
  print_r(json_encode($post_arr));