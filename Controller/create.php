
<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Blog.php';

$db = (new Database())->connect();
$blog = new Blog($db);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $image = null;

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "-" . basename($_FILES['image']['name']);
        $target = __DIR__ . "/../uploads/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    if ($blog->create($title, $content, $image)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='error'>Failed to create post.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create New Post</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Create New Post</h2>
    <form method="POST" enctype="multipart/form-data" class="post-form">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="6" required></textarea><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" name="submit" value="Create Post" class="btn">
    </form>

    <a href="index.php" class="back-link">Back to blog</a>
</div>

</body>
</html>
