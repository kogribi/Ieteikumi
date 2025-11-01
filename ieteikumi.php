<?php
session_start();
require 'connect.php';
$result = $conn->query("SELECT * FROM recommendations ORDER BY created_at DESC"); //connects to database, sends command to sql, gives object with rows info about columns by the query
$recommendations = []; // array for the recomm
while ($row = $result->fetch_assoc()) { // makes each row an associative array
    $recommendations[] = $row; // add each row to the array
}

if (isset($_POST['genre'])){
     $_SESSION['selected_genre']=$_POST['genre'];
} else {
    $_SESSION['selected_genre']='Home';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="ieteikumi.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen max-w-full">
    <header class="header">
        <div class="title">
            Ieteikumi.lv
        </div>
        <div>
        <a href="create.php"><button class="button_create">Izveidot ieteikumu</button></a>
        </div>
        <div>
            <?php if (!isset($_SESSION['user_id'])): ?>
    <a href="register.php"><button class="boton-elegante">Reģistrēties</button></a>
    <a href="login.php"><button class="boton-elegante">Pieteikties</button></a>
<?php else: ?>
    <a href="profile.php"><button class="boton-elegante">Profils</button></a>
    <a href="logout.php"><button class="boton-elegante">Atteikties</button></a>
<?php endif; ?>
        </div>
    </header>
    <main>
    <div class="sidebar">
    <div>
<form method="post">
  <button type="submit" name="genre" value="Home" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Home'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/> Sākums
  </button>

  <button type="submit" name="genre" value="Food" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Food'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/cutlery.png" alt="cutlery"/> Ēdieni
  </button>

  <button type="submit" name="genre" value="Video" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Video'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/video-call.png" alt="video"/> Video
  </button>

  <button type="submit" name="genre" value="Games" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Games'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/controller.png" alt="games"/> Spēles
  </button>

  <button type="submit" name="genre" value="Places" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Places'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/national-park.png" alt="park"/> Vietas
  </button>

  <button type="submit" name="genre" value="Products" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Products'){echo " active";} ?>">
    <img width="25" height="25" src="https://img.icons8.com/ios/50/product--v1.png" alt="product"/> Producti
  </button>
</form>
    </div>
    <div>
        <button type="submit" name="genre" value="Palidziba" class="sidebar-options">
            <img width="25" height="25" src="https://img.icons8.com/ios/50/question-mark--v1.png" alt="home--v1"/>Palīdzība
        </button>
       <button type="submit" name="genre" value="Iestatijumi" class="sidebar-options">
            <img width="25" height="25" src="https://img.icons8.com/ios/50/settings--v1.png" alt="cutlery"/>Iestatijumi
        </button>
    </div>
    </div>
    <div class="outer_content">
    <div class="content">
        <?php foreach ($recommendations as $rec){ ?> <!-- go through every item in array one by one and store each of them in $rec -->
            <?php if ($_SESSION['selected_genre']==='Home') { ?>
        <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Food' && $rec['genre']==='Ēdiens') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Food' && $rec['genre']==='Ēdiens') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Video' && $rec['genre']==='Video') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Games' && $rec['genre']==='Spēles') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Places' && $rec['genre']==='Vietas') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Products' && $rec['genre']==='Producti') { ?>
            <div class="item"> 
            <div class="images">
                <img width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/><br>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/><br>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/><br>
                        <div style="text-align:center;"><?php if($rec['genre']==='Video' || $rec['genre']==='Vietas'){echo $rec['time'] . "h";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Producti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
    </div>
    </main>
    </div>
</body>
</html>