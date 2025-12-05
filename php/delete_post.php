<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo 'Not logged in';
    exit;
}

if (isset($_POST['post_id']) || isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM likes WHERE post_id=?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM recommendations WHERE id=?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    header("Location: ../ieteikumi.php");


}