<?php
session_start();
require 'php/connect.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT recommendations.* FROM recommendations JOIN likes ON recommendations.id = likes.post_id WHERE likes.user_id = ? ORDER BY recommendations.created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$UserLikedRecomendations = []; 
while ($row = $result->fetch_assoc()) { 
    $UserLikedRecomendations[] = $row; 
}
$stmt = $conn->prepare("SELECT * FROM recommendations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$UserCreatedRecomendations = []; 
while ($row = $result->fetch_assoc()) { 
    $UserCreatedRecomendations[] = $row; 
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
    <title>Profile</title>
    <link href="css/profile.css" rel="stylesheet">
</head>
<body>
    <script>
        let darkmode = localStorage.getItem('darkmode')

        const enableDarkmode = () => {
            document.body.classList.add('darkmode')
            localStorage.setItem('darkmode', 'active')
        }

        const disableDarkmode = () => {
            document.body.classList.remove('darkmode')
            localStorage.setItem('darkmode', 'inactive')
        }

        if(darkmode === "active") enableDarkmode()

    </script>
    <div class="min-h-screen max-w-full">
    <header class="header">
        <div class="title">
            <a href="ieteikumi.php">Ieteikumi.lv</a>
        </div>
        <div class="login_buttons">
            <script>
               function myFunction() {
                    if (confirm("Vai tu esi parliecināts? (izdzēsis visus tavus datus uz mūžu!)")) {
                       window.location.href = "php/delete_data.php";
                    } else {
                        
                    }} 
            </script>
            <button onclick="myFunction()" class="boton-elegante"><span>Izdzēst datus</span><img width="25" height="25" src="https://img.icons8.com/ios/50/delete-database.png" alt="home--v1"/></button>
            <a href="php/logout.php"><button class="boton-elegante"><span>Atteikties</span><img width="25" height="25" src="https://img.icons8.com/ios/50/exit--v1.png" alt="home--v1"/></button></a>
            
        </div>
    </header>
    <main>
    <div class="profile_outer_content">
    <div class="content-title">Jūsu patikāmie ieteikumi:</div>
    <div class="content">
        <?php foreach ($UserLikedRecomendations as $UserLikedRecomendation){ ?> 
    <div class="item"  
        data-title="<?php echo htmlspecialchars($UserLikedRecomendation['title']); ?>"
        data-image="<?php echo htmlspecialchars($UserLikedRecomendation['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
        data-genre="<?php echo htmlspecialchars($UserLikedRecomendation['genre']); ?>"
        data-rating="<?php echo htmlspecialchars($UserLikedRecomendation['rating']); ?>"
        data-id="<?php echo htmlspecialchars($UserLikedRecomendation['id']); ?>"
        data-user="<?php echo htmlspecialchars($UserLikedRecomendation['user']); ?>"
        data-time="<?php echo htmlspecialchars($UserLikedRecomendation['time']); ?>"
        data-price="<?php echo htmlspecialchars($UserLikedRecomendation['price']); ?>"
        data-length="<?php echo htmlspecialchars($UserLikedRecomendation['length']); ?>"
        data-created_at="<?php $date=new DateTime($UserLikedRecomendation['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
        data-desc="<?php echo htmlspecialchars($UserLikedRecomendation['description'] ?? ''); ?>"
        data-user_id="<?php echo htmlspecialchars($UserLikedRecomendation['user_id'] ?? ''); ?>"
    >
        <div class="images">
            <img width="100%" height="100%" class="image" src="<?php if (isset($UserLikedRecomendation['image'])){ echo $UserLikedRecomendation['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
        </div>
        <div class="text">
            <div class="small_title"><?php echo $UserLikedRecomendation['title'] ?></div>
            <div class="ratings">
                <div class="rating">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                    <div style="text-align:center;"><?php echo $UserLikedRecomendation['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                </div>
                <div class="genre">
                    <img width="50" height="50" src="<?php if($UserLikedRecomendation['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($UserLikedRecomendation['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($UserLikedRecomendation['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($UserLikedRecomendation['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($UserLikedRecomendation['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($UserLikedRecomendation['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";} ?>" alt="cutlery"/>
                    <div style="text-align:center;"><?php echo $UserLikedRecomendation['genre'] ?></div>
                </div>
                <div class="time">
                    <img width="50" height="50" src="<?php if($UserLikedRecomendation['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($UserLikedRecomendation['genre']==='Video' || $UserLikedRecomendation['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($UserLikedRecomendation['genre']==='Ēdiens' || $UserLikedRecomendation['genre']==='Spēles' || $UserLikedRecomendation['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                    <div style="text-align:center;"><?php if($UserLikedRecomendation['genre']==='Vietas'){echo $UserLikedRecomendation['length'] . "km";} if($UserLikedRecomendation['genre']==='Video' || $UserLikedRecomendation['genre']==='Aktivitāte'){echo $UserLikedRecomendation['time'] . "h";} if($UserLikedRecomendation['genre']==='Ēdiens' || $UserLikedRecomendation['genre']==='Spēles' || $UserLikedRecomendation['genre']==='Produkti'){echo $UserLikedRecomendation['price'];} ?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    </div>
    </div>
    <div class="profile_outer_content">
    <div class="content-title">Jūsu izveidotie ieteikumi:</div>
    <div class="content">
        <?php foreach ($UserCreatedRecomendations as $UserCreatedRecomendation){ ?> 
    <div class="item"  
        data-title="<?php echo htmlspecialchars($UserCreatedRecomendation['title']); ?>"
        data-image="<?php echo htmlspecialchars($UserCreatedRecomendation['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
        data-genre="<?php echo htmlspecialchars($UserCreatedRecomendation['genre']); ?>"
        data-rating="<?php echo htmlspecialchars($UserCreatedRecomendation['rating']); ?>"
        data-id="<?php echo htmlspecialchars($UserCreatedRecomendation['id']); ?>"
        data-user="<?php echo htmlspecialchars($UserCreatedRecomendation['user']); ?>"
        data-time="<?php echo htmlspecialchars($UserCreatedRecomendation['time']); ?>"
        data-price="<?php echo htmlspecialchars($UserCreatedRecomendation['price']); ?>"
        data-length="<?php echo htmlspecialchars($UserCreatedRecomendation['length']); ?>"
        data-created_at="<?php $date=new DateTime($UserCreatedRecomendation['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
        data-desc="<?php echo htmlspecialchars($UserCreatedRecomendation['description'] ?? ''); ?>"
        data-user_id="<?php echo htmlspecialchars($UserCreatedRecomendation['user_id']); ?>"
    >
        <div class="images">
            <img width="100%" height="100%" class="image" src="<?php if (isset($UserCreatedRecomendation['image'])){ echo $UserCreatedRecomendation['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
        </div>
        <div class="text">
            <div class="small_title"><?php echo $UserCreatedRecomendation['title'] ?></div>
            <div class="ratings">
                <div class="rating">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                    <div style="text-align:center;"><?php echo $UserCreatedRecomendation['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                </div>
                <div class="genre">
                    <img width="50" height="50" src="<?php if($UserCreatedRecomendation['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($UserCreatedRecomendation['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($UserCreatedRecomendation['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($UserCreatedRecomendation['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($UserCreatedRecomendation['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($UserCreatedRecomendation['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";} ?>" alt="cutlery"/>
                    <div style="text-align:center;"><?php echo $UserCreatedRecomendation['genre'] ?></div>
                </div>
                <div class="time">
                    <img width="50" height="50" src="<?php if($UserCreatedRecomendation['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($UserCreatedRecomendation['genre']==='Video' || $UserCreatedRecomendation['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($UserCreatedRecomendation['genre']==='Ēdiens' || $UserCreatedRecomendation['genre']==='Spēles' || $UserCreatedRecomendation['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                    <div style="text-align:center;"><?php if($UserCreatedRecomendation['genre']==='Vietas'){echo $UserCreatedRecomendation['length'] . "km";} if($UserCreatedRecomendation['genre']==='Video' || $UserCreatedRecomendation['genre']==='Aktivitāte'){echo $UserCreatedRecomendation['time'] . "h";} if($UserCreatedRecomendation['genre']==='Ēdiens' || $UserCreatedRecomendation['genre']==='Spēles' || $UserCreatedRecomendation['genre']==='Produkti'){echo $UserCreatedRecomendation['price'];} ?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    </div>
    </div>
    </main>
        <?php 
    $user_id = $_SESSION['user_id'] ?? null;
    $liked_posts = [];
    if ($user_id) {
    $result = $conn->query("SELECT post_id FROM likes WHERE user_id = $user_id");
    while ($row = $result->fetch_assoc()) {
        $liked_posts[] = (int)$row['post_id'];
    }
}
     ?>
<script>
    const likedPosts = <?= json_encode($liked_posts) ?>;
</script>
    <div id="myModal" class="modal">
        
        
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="Modal_id" ></div>
        <div id="Modal_title" ></div>
        <div class="Modal_img_container"><img id="Modal_image"></div>
        <div class="Modal_container">
        <div class="Modal_ratings_container">
            <div class="delete-post">
        <button class="btn" id="delete" data-post-id="" data-user-id="">
            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
            </svg>
        </button>
        </div>
        <div>
            <div id="Modal_genre_image_container"> <img src="https://img.icons8.com/ios/50/image--v1.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_genre"> </div>
        </div>
        <div>
            <div id="Modal_rating_image_container"> <img  src="https://img.icons8.com/ios/50/rating.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_rating"></div>
        </div>
        <div>
            <div id="Modal_time_image_container"> <img  src="https://img.icons8.com/ios/50/time_2.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_time" ></div>
        </div>
        <div>
            <div id="Modal_price_image_container"> <img  src="https://img.icons8.com/ios/50/price-tag-euro.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_price" ></div>
        </div>
        <div>
            <div id="Modal_length_image_container"> <img  src="https://img.icons8.com/ios/50/trail--v2.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_length" ></div>
        </div>
        <div class="like_container">
            <label class="like">
                <input id="like" type="checkbox" data-post-id="">
                    <div class="checkmark">
                    <svg viewBox="0 0 256 256">
                <rect fill="none" height="256" width="256"></rect>
                <path d="M224.6,51.9a59.5,59.5,0,0,0-43-19.9,60.5,60.5,0,0,0-44,17.6L128,59.1l-7.5-7.4C97.2,28.3,59.2,26.3,35.9,47.4a59.9,59.9,0,0,0-2.3,87l83.1,83.1a15.9,15.9,0,0,0,22.6,0l81-81C243.7,113.2,245.6,75.2,224.6,51.9Z" stroke-width="20px" stroke="#808080" fill="none"></path></svg>
            </div>
        </label>
        </div>
        </div>
        </div>
        <div class="Modal_main_content">
            <div class="Modal_info">
            <div class="Modal_user_div">
            <div id="Modal_user_image_container"> <img width="50" height="50" src="https://img.icons8.com/ios/50/user--v1.png"> </div>
            <div id="Modal_user" ></div>
            </div>
            <div class="Modal_created_at">
            <div id="Modal_created_at_image_container"> <img width="50" height="50" src="https://img.icons8.com/ios/50/calendar--v1.png"> </div>
            <div id="Modal_created_at" ></div>
            </div>
            </div>
            <div class="Modal_desc_container">
            <div id="Modal_desc" ></div>
            </div>
        </div>
<script>
const CurrentUserId = "<?php if(isset($_SESSION['user_id'])) {echo $_SESSION['user_id'];}else{echo "false";} ?>";
var items = document.querySelectorAll('.item');

items.forEach(function(item) {
    item.addEventListener('click', function() {
        var id = parseInt(item.dataset.id);

        
        document.getElementById('Modal_title').textContent = item.dataset.title;
        document.getElementById('Modal_image').src = item.dataset.image;
        document.getElementById('Modal_genre').textContent = item.dataset.genre;
        document.getElementById('Modal_rating').textContent = item.dataset.rating;
        document.getElementById('Modal_id').textContent = id;
        document.getElementById('Modal_user').textContent = item.dataset.user;
        document.getElementById('Modal_time').textContent = item.dataset.time;
        document.getElementById('Modal_price').textContent = item.dataset.price;
        document.getElementById('Modal_length').textContent = item.dataset.length;
        document.getElementById('Modal_created_at').textContent = item.dataset.created_at;
        document.getElementById('Modal_desc').textContent = item.dataset.desc;
        document.getElementById('delete').dataset.postId = id;
        document.getElementById('delete').dataset.userId = item.dataset.user_id;

        var PostUserId = document.getElementById('delete').dataset.userId;
        console.log(PostUserId);
        console.log(CurrentUserId);
        if(CurrentUserId !== PostUserId){
            document.getElementById("delete").style.display = "none";
        }
        
        var likeCheckbox = document.getElementById('like');
        var isLiked = likedPosts.includes(id);
        
        
        likeCheckbox.replaceWith(likeCheckbox.cloneNode(true));
        likeCheckbox = document.getElementById('like');
        
        
        likeCheckbox.checked = isLiked;
        likeCheckbox.dataset.postId = id;
        
        
        var svgPath = likeCheckbox.querySelector('path');
        if (svgPath) {
            svgPath.setAttribute('fill', isLiked ? '#FF0000' : 'none');
        }

        likeCheckbox.addEventListener('click', function() {
            var postId = parseInt(this.dataset.postId);
            var liked = this.checked;

            
            var svgPath = this.querySelector('path');
            if (svgPath) svgPath.setAttribute('fill', liked ? '#FF0000' : 'none');

            
            if (liked) {
                if (!likedPosts.includes(postId)) likedPosts.push(postId);
            } else {
                var index = likedPosts.indexOf(postId);
                if (index > -1) likedPosts.splice(index, 1);
            }

            
            fetch('php/like.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'post_id=' + postId + '&liked=' + (liked ? 1 : 0)
            })
            .then(function(res) { return res.text(); })
            .then(function(data) {
                console.log('Like updated:', data);
            })
            .catch(function(err) {
                console.error(err);
            });
        });
        var deletePost = document.getElementById('delete');
        deletePost.addEventListener('click', async function() {
        let postId = this.dataset.postId;
        let userId = this.dataset.userId;
         await fetch('php/delete_post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'post_id=' + postId + '&user_id=' + userId
        });
        location.reload();
        });
        document.getElementById('myModal').style.display = "block";
    });
});
                  
var span = document.getElementsByClassName("close")[0];
var modal = document.getElementById("myModal");

span.onclick = function() {
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
</script>
    </div>
    </html>
