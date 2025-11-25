<?php
session_start();


if (!isset($_SESSION['username'])) {
   header("Location: register.php");
   
    exit;
}

require 'connect.php';

if (isset($_POST['submit'])) {
    $user = $_SESSION['username'];
    $user_id= $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $genre = $_POST['genre'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $title = $_POST['title'];
    $length = $_POST['length'];
    $imagePath = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { // $_FILES images temp place and $_FILES error= all the error info upload_err_ok=0(no errors)
        $fileTmpPath = $_FILES['image']['tmp_name']; // C:\laragon\www\project\tmp\php1234.tmp
        $fileName = $_FILES['image']['name']; // photo.jpg
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // only the jpg

        $newFileName = uniqid() . '.' . $fileExtension; // random_bs.jpg

        $uploadDir = 'uploads/'; // folder place for uploads
        $destPath = $uploadDir . $newFileName; // uploads/random_bs.jpg

        if(move_uploaded_file($fileTmpPath, $destPath)) { //C:\laragon\www\project\tmp\php1234.tmp -> upload/random_bs.jpg
            $imagePath = $destPath; // upload/random_bs.jpg
        }
    } else {
        echo "nav vai nesanaca izmantot image";
    }

    if(empty($rating) || empty($genre) || empty($title) || empty($description)) {
        echo "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO recommendations (user, user_id, title, rating, genre, time, price, length, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisissdiss", $user, $user_id, $title, $rating, $genre, $time, $price, $length, $description, $imagePath);
        $stmt->execute();

        header("Location: ieteikumi.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Recommendation</title>
    <link href="create.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form class="form" method="POST" action="" enctype="multipart/form-data">
    <p class="title">Izveido ieteikumu! </p>
    <p class="message">Piepildi visu! <b>Ja kaut kas nav vajadzīgs ievadi 0!</b></p>
        <label>
        <input class="input" type="text" name="title" maxlength="100" required>
        <span>Tituls</span>
        </label>

        <label>
        <input class="input" type="number" name="rating" min="1" max="10" required>
        <span>Novertējums (1-10)</span>
        </label>
        <div class="container">
        <label>
        <div class="select">
        <select name="genre" maxlength="50" required>
            <option value="Ēdiens">Ēdiens</option>
            <option value="Video">Video</option>
            <option value="Spēles">Spēles</option>
            <option value="Vietas">Vietas</option>
            <option value="Produkti">Produkti</option>
            <option value="Aktivitāte">Aktivitāte</option>
        </select>
        </div>
        </div>
        </label>
        </div>
        <label>
        <input class="input" type="text" name="time" maxlength="50" required>
        <span>Laiks</span>
        </label>
        <label>
        <input class="input" type="number" name="length" required>
        <span>Garums</span>
        </label>

        <label>
        <input class="input" type="number" step="0.00" name="price" required>  
        <span>Cena</span>
        </label>

        <label><span>Paskaidrojums</span>
        <textarea name="description" rows="4" cols="50" required></textarea>
        
        </label>

        <label class="drop-container">
        <span class="drop-title">Speid šeit lai pievienotu bildi!</span>
    
        <input class="input" type="file" name="image" accept="image/*" id="file-input">
        </label>
        <input class="submit" type="submit" name="submit" value="Create Recommendation">
        <p class="signin">Aiziet <a href="ieteikumi.php">atpakaļ?</a> </p>
    </form>
</body>
</html>