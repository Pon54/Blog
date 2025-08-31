<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Blog.php';

$db = (new Database())->connect();
$blog = new Blog($db);

$posts = $blog->getAllPost();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="../css/Indexstyle.css">
</head>
<body>

<div class="container">
    <h2>Blog Posts</h2>
    <a href="create.php">Create New Post</a><br><br>

    <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <?php if ($post['image']): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" style="max-width: 150px;" alt="Blog Image">
                <?php endif; ?>
                <small>Posted on: <?php echo htmlspecialchars($post['created_at']); ?></small>
                <div class="actions">
                    <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>

</body>
</html>