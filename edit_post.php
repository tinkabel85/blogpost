<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && $_POST['submit'] === 'save_changes') {
  if (!isset($_GET['id'])) {
    echo "Error: No post ID specified.";
    exit();
  }

  $id = $_GET['id'];
  $file = 'filestore/post_' . $id . '.json';

  if (!file_exists($file)) {
    echo "Error: Post not found.";
    exit();
  }

  $post = json_decode(file_get_contents($file), true);
  // Update the post with the new information
  $post['title'] = $_POST['title'];
  $post['content'] = $_POST['content'];

  // Save the updated post
  file_put_contents($file, json_encode($post));

  // Redirect the user back to the post
  header("Location: get_posts.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "Error: No post ID provided.";
  exit();
}

$id = $_GET['id'];
$file = 'filestore/post_' . $id . '.json';

if (!file_exists($file)) {
  echo "Error: Post not found.";
  exit();
}

$post = json_decode(file_get_contents($file), true);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Post</title>
</head>

<body>
  <h1>Edit Post</h1>
  <form method="POST" action="edit_post.php?id=<?php echo $id ?>">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>">
    <label for="content">Content:</label>
    <textarea id="content" name="content"><?php echo $post['content']; ?></textarea>
    <button type="submit" name="submit" value="save_changes">Save Changes</button>
  </form>
</body>

</html>