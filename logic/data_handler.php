<?php 

function getImageUrl($urlString): String {
    if ($urlString == null || empty($urlString)) {
        return "images/codabee_logo_red.png";
    } else {
        return "./actions/uploads/".$urlString;
    }
}

function createPost($post, $userId, $username, $picture) {
    $profilePicture = getImageUrl($picture);
    $id = $post['postId'];
    $text = $post['text'];
    $image = $post['postImage'];
    $date = $post['date'];
    $href = "profile.php?userId=".$userId."&username=".$username."&profilePicture=".$picture;
    $deletePostLink = "actions/delete_post.php?postId=".$id."&userId=".$userId;
    $startHtml = '<div class="container">
                    <div class="post-head">
                        <a href="'.$href.'">
                            <img src="'.$profilePicture.'"alt="" class="avatar">
                        </a>
                        <div class="post-infos">
                            <h4>'.$username.'</h4>
                            <h6>'.$date.'</h6>
                        </div>
                        <div class="post-param">
                            <img src="images/dots.png" alt="menu" class ="inverted-colors">
                            <a href="'.$deletePostLink.'"><img src="images/close.png" alt="supprimer", class="inverted-colors"></a>
                        </div>
                    </div>
                    <p class="post-text">'.$text.'</p>';
    $endHtml = '<div class="post-footer">
                        <div class="reactions">
                            <div class="likes">
                                <img src="images/like-blue.png" alt="">
                                <p>1</p>
                            </div>
                            <div>
                                <p>18 partages</p>
                            </div>
                        </div>
                        <hr>
                        <div class="button-stack">
                            <div class="post-button">
                                <img src="images/like.png" alt="like" class="inverted-colors">
                                <p>J\'aime</p>
                            </div>
                            <div class="post-button">
                                <img src="images/comment.png" alt="like" class="inverted-colors">
                                <p>Commenter</p>
                            </div>
                            <div class="post-button">
                                <img src="images/share.png" alt="like" class="inverted-colors">
                                <p>Partager</p>
                            </div>
                        </div>
                    </div>
                </div>';

    if  (isset($image) && !empty($image)) {
        $midHTML = '<img src="./actions/uploads/'.$image.'" alt="image du post" class="post-image">
        <?php endif; ?>';
        return $startHtml.$midHTML.$endHtml;
    } else {
        return $startHtml.$endHtml;
    }
}