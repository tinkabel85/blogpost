<?php

date_default_timezone_set('Europe/Berlin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Username
  $username = $_POST['username'];

  if (empty($username) || strlen($username) < 3) {
    echo "<p>Error: Name requires a minimum of 3 characters</p>";
    exit;
  }

  //Post title
  $title = $_POST['title'];
  if (empty($title)) {
    echo "<p>Error: Title cannot be empty.</p>";
    exit;
  }

  //Post text
  $content = $_POST['content'];
  if (empty($content) || strlen($content) < 5) {
    echo "<p>Error: Post cannot be empty or too short.</p>";
    exit;
  }

// re-direct to the main page
  header("Location: /get_posts.php");
}

$post_id = time();
$filename = 'filestore/post_' . $post_id . '.json';

$file = fopen($filename, 'w');

  // Write to file
fwrite($file, json_encode([
  'id' => $post_id,
  'name' => $username,
  'title' => $title,
  'content' => $content,
  'date_created' => date("Y-m-d h:i:sa"),
], JSON_PRETTY_PRINT));


fclose($file);

