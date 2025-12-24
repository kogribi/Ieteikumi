<?php
session_start();


if (!isset($_SESSION['username'])) {
   header("Location: register.php");
   
    exit;
} 

require 'connect.php';

if (isset($_SESSION['user_id'])) {
    $user_id= $_SESSION['user_id'];
    $_SESSION['user_id']=null;
    $_SESSION['username']=null;
    $stmt = $conn->prepare("DELETE FROM likes WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    
    $stmt = $conn->prepare("DELETE FROM recommendations WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    header("Location: ../index.php");
}