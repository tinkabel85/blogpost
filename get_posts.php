<!DOCTYPE html>
<html>

<head>
  <title>My Blog</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

  <?php
  echo '<a class="add-post__btn" href="./index.php" class="post__btn--add">Add a new post</a>';


  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      // Retrieve a single post by ID
      $id = $_GET['id'];
      $filename = "filestore/post_" . $id . '.json';
      if (file_exists($filename)) {
        $post = json_decode(file_get_contents($filename), true);
        echo '<div class="post">';
        echo '<h2 class="post__title">' . $post['title'] . '</h2>';
        echo '<p class="post__author">' . $post['name'] . '</p>';
        echo '<p class="post__content">' . $post['content'] . '</p>';
        echo '<a class="post__btn--edit" href="/edit_post.php?id=' . $post['id'] . '">Edit</a>';
        echo '<form action="/delete_post.php?id=' . $post['id'] . '" method="POST">';
        echo '<input type="hidden" name="_method" value="DELETE">';
        echo '<input class="post__btn--delete" type="submit" value="Delete">';
        echo '</form>';
        echo '</div>';
      } else {
        echo '<p>Post not found</p>';
      }
    } else {
      // Retrieve all posts
      $files = glob('filestore/post_*');

      $posts = [];

      foreach ($files as $file) {
        $content = file_get_contents($file);
        $post = json_decode($content, true);
        $posts[] = $post;
      }


      foreach ($posts as $post) {
        echo '<div class="post">';
        echo '<div class="post__header">';
        echo '<h2  class="post__title">' . $post['title'] . '</h2>';
        echo '<p class="post__author">' . $post['name'] . '</p>';
        echo '</div>';
        echo '<p class="post__content">' . $post['content'] . '</p>';
        echo '<p>' . $post['id'] . '</p>';
        echo '<div class="post__btns">';
        echo '<a  class="post__btn--edit" href="/edit_post.php?id=' . $post['id'] . '">Edit</a>';
        echo '<form action="/delete_post.php?id=' . $post['id'] . '" method="POST">';
        echo '<input type="hidden" name="_method" value="DELETE">';
        echo '<input class="post__btn--delete" type="submit" value="Delete">';
        echo '</form>';
        echo '</div>';
        echo '</div>';
      }

  ?>

      <form action="" method="GET">
        <label for="search">Search post by ID:</label>
        <input id="search__input" type="text" name="id" id="search">
        <button class="search__btn" type="submit">Search</button>
      </form>
  <?php
    }
  }
  ?>
</body>

</html>