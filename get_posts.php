<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $files = glob('filestore/post_*');

  $posts = [];

  foreach ($files as $file) {
    $content = file_get_contents($file);
    $post = json_decode($content, true);
    $posts[] = $post;
  }


  foreach ($posts as $post) {
    echo '<h2>' . $post['title'] . '</h2>';
    echo '<p>' . $post['name'] . '</p>';
    echo '<p>' . $post['content'] . '</p>';
    echo '<button>' . 'edit' . '</button>';
    echo '<hr>';
  }
  // echo '<pre>' . json_encode($posts, JSON_PRETTY_PRINT);
  // echo '</pre>';
  // echo "<hr>";
}
