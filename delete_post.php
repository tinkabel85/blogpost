<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'DELETE') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $file = 'filestore/post_' . $id . '.json';

    if (file_exists($file)) {
      unlink($file);
      echo 'success';
      header("Location: /get_posts.php");
      exit();
    } else {
      echo "Post not found";
    }
  } else {
    echo "ID parameter missing";
  }
}
