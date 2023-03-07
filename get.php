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

  echo '<pre>';
  echo "The name is : " . $username . "\n";
  echo "The title of the post : " . $title . "\n";
  echo "The text to be posted :" . $content . "\n";
  echo '</pre>';
}


// $prefix = 'post_'. $username . '_' ;
// // $filename = $prefix . $username . uniqid();
// $filename = tempnam('filestore/', $prefix);
// //$filename = 'oksana.txt';
// rename($filename, $filename .= '.txt');

$post_id = time();
$filename = 'filestore/post_' . $post_id . '_' . $username . '.txt';

$file = fopen($filename, 'w');


fwrite($file, json_encode([
  'id' => uniqid(),
  'name' => $username,
  'title' => $title,
  'content' => $content,
  'date_created' => date("Y-m-d h:i:sa"),
], JSON_PRETTY_PRINT));


fclose($file);


// file_exists('filestore/text.txt'); //true

// #echo file_get_contents('filestore/text.txt');

// file_put_contents('filestore/text.txt', 'Hola!'); //appends

//echo file_get_contents('filestore/text.txt');

// json_encode([
//   'name' => 'hh',
// ]);