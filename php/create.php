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
    $imageErorrs = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { // $_FILES images temp place and $_FILES error= all the error info upload_err_ok=0(no errors)
        $fileTmpPath = $_FILES['image']['tmp_name']; // C:\laragon\www\project\tmp\php1234.tmp
        $fileName = $_FILES['image']['name']; // photo.jpg
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // only the jpg

        if($fileExtension=="jpg" || $fileExtension=="jpeg"){
            $source = imagecreatefromjpeg($fileTmpPath); // saglaba image pec tipa
        } else if($fileExtension=="png"){
            $source = imagecreatefrompng($fileTmpPath); 
        } else {
            $imageErorrs = "nepareizs bildes tips";
        }

        

    if ($imageErorrs==""){
        $maxWidth = 1200;
        $width = imagesx($source);
        $height = imagesy($source);

        if ($width > $maxWidth) {
        $newHeight = ($maxWidth / $width) * $height;
        $newImage = imagescale($source, $maxWidth, $newHeight); // save the new edited image
        } else {
        $newImage = $source;
        }

        $newFileName = uniqid() . '.webp'; // random_bs.webp

        $uploadDir = '../uploads/'; // folder place for uploads
        $destPath = $uploadDir . $newFileName; // uploads/random_bs.webp

        imagewebp($newImage, $destPath, 80); // save as webp 80% quality
        imagedestroy($source);
        imagedestroy($newImage);
        $imagePath = str_replace("../","",$destPath);
    }
    } else {
        $imageErorrs = "nav vai nesanaca izmantot image";
    }
    if ($imageErorrs==""){
    if(empty($rating) || empty($genre) || empty($title) || empty($description)) {
        echo "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO recommendations (user, user_id, title, rating, genre, time, price, length, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisissdsss", $user, $user_id, $title, $rating, $genre, $time, $price, $length, $description, $imagePath);
        $stmt->execute();

        header("Location: ../ieteikumi.php");
    }}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Recommendation</title>
    <link href="../css/create.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<script>
        let darkmode = localStorage.getItem('darkmode')
        const themeSwitch = document.getElementById('theme-switch')

        const enableDarkmode = () => {
            document.body.classList.add('darkmode')
            localStorage.setItem('darkmode', 'active')
        }

        const disableDarkmode = () => {
            document.body.classList.remove('darkmode')
            localStorage.setItem('darkmode', null)
        }

        if(darkmode === "active") enableDarkmode()

        themeSwitch.addEventListener("click", function() {
            darkmode = localStorage.getItem('darkmode')
            darkmode !== "active" ? enableDarkmode() : disableDarkmode()
        })
    </script>
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
        <input class="input" type="text" step="0.01" name="length" required>
        <span>Garums</span>
        </label>

        <label>
        <input class="input" step="0.01" type="decimal" step="0.00" name="price" required>  
        <span>Cena</span>
        </label>

        <label><span>Paskaidrojums</span>
        <textarea name="description" rows="4" cols="50" required></textarea>
        
        </label>

        <label class="drop-container">
        <span class="drop-title">Speid šeit lai pievienotu bildi! <br> (png, jpeg vai jpg)</span>
    
        <input class="input"  type="file" name="image" accept="image/*" id="file-input">
        </label>
        <em style="color: red"><?php if (isset($_POST['submit'])) { echo $imageErorrs;} ?></em>
        <input class="submit" type="submit" name="submit" value="Create Recommendation">
        <p class="signin">Aiziet <a href="../ieteikumi.php">atpakaļ?</a> </p>
    </form>
</body>
</html>