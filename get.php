<?php

date_default_timezone_set('Europe/Berlin');
// Get post ID from query parameter
//$post_id = isset($_GET['id']) ? $_GET['id'] : time();

if (isset($_GET['id'])) {
  $post_id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $post_id = time();

  $filename = 'filestore/post_' . $post_id . '.json';

  // Check if file already exists
  $file_exists = file_exists($filename);

  // Username validation
  $username = $_POST['username'];

  if (empty($username) || strlen($username) < 3) {
    echo "<p>Error: Name requires a minimum of 3 characters</p>";
    exit;
  }

  //Post title validation
  $title = $_POST['title'];
  if (empty($title)) {
    echo "<p>Error: Title cannot be empty.</p>";
    exit;
  }

  //Post text validation
  $content = $_POST['content'];
  if (empty($content) || strlen($content) < 5) {
    echo "<p>Error: Post cannot be empty or too short.</p>";
    exit;
  }

 // Open and Write to file
  $file = fopen($filename, 'w');

  fwrite($file, json_encode([
    'id' => $post_id,
    'name' => $username,
    'title' => $title,
    'content' => $content,
    'date_created' => date("Y-m-d h:i:sa"),
  ], JSON_PRETTY_PRINT));

  fclose($file);

  // re-direct to the main page
  header("Location: /get_posts.php");
}


// elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {

//   echo "editing the fle";
//   Get file path
//   $filename = 'filestore/post_' . $post_id . '.json';

//   Check if file exists
//   if (!file_exists($filename)) {
//     echo "Error: Post not found.";
//     exit;
//   }

//   Validate inputs
//   $username = $_POST['name'];
//   $title = $_POST['title'];
//   $content = $_POST['content'];

//   Validate username
//   if (empty($username) || strlen($username) < 3) {
//     echo "<p>Error: Name requires a minimum of 3 characters</p>";
//     exit;
//   }

//   Validate title
//   if (empty($title)) {
//     echo "<p>Error: Title cannot be empty.</p>";
//     exit;
//   }

//   Validate content
//   if (empty($content) || strlen($content) < 5) {
//     echo "<p>Error: Post cannot be empty or too short.</p>";
//     exit;
//   }

//   Load existing post data
//   $post_data = json_decode(file_get_contents($filename), true);

//   Update post data
//   $post_data['name'] = $username;
//   $post_data['title'] = $title;
//   $post_data['content'] = $content;

//   Write updated post data to file
//   $file = fopen($filename, 'w');
//   fwrite($file, json_encode($post_data, JSON_PRETTY_PRINT));
//   fclose($file);

//   Redirect to main page
//   header("Location: /get_posts.php");
// } 