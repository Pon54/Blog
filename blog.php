<?php

class Blog {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Post
    public function create($title, $content, $image) {
        $sql = "INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['title' => $title, 'content' => $content, 'image' => $image]);
    }

    public function getAllPost() {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single post by ID
    public function getById($id) {
        $sql = "SELECT * FROM posts WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // delete post
public function delete($id) {
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

// update post
public function update($id, $title, $content, $image = null) {

    // coding check if the image is existing
    if ($image) {
        $sql = "UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id";
        $params = [':id' => $id, ':title' => $title, ':content' => $content, ':image' => $image];
    } else {
        $sql = "UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id";
        $params = [':id' => $id, ':title' => $title, ':content' => $content, ':image' => $image];
    }
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
}

}
?>