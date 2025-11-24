<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo 'Not logged in';
    exit;
}

if (isset($_POST['post_id'], $_POST['liked'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $liked = $_POST['liked'] == 1;

    if ($liked) {
        $sql = "INSERT INTO likes (user_id, post_id) 
                SELECT ?, ? WHERE NOT EXISTS (SELECT 1 FROM likes WHERE user_id=? AND post_id=?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $user_id, $post_id, $user_id, $post_id);
        $stmt->execute();
    } else {
        $sql = "DELETE FROM likes WHERE user_id=? AND post_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $post_id);
        $stmt->execute();
    }

    echo 'OK';
} else {
    echo 'Missing data';
}
?>