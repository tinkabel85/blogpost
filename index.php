<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./styles.css">
</head>

<body>
  <form action="/get.php" method="POST">
    <label for="username">Name:</label>
    <input type="text" name="username" placeholder="Please enter your name">
    <br />
    <label for="title">Post Title:</label>
    <input type="text" name="title" placeholder="Title">
    <br />
    <textarea type="text" name="content" placeholder="Here goes your post...." rows="5" cols="55"></textarea>
    <br />
    <input type="submit" value="Submit">
  </form>

  <form action="/get_posts.php" method="GET">
    <input type="submit" value="Show all posts">
  </form>
</body>

</html>