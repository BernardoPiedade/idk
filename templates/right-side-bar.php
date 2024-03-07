<div class="col-md-3 py-3">
    <div>
        <h4>Popular Posts:</h4>
        <hr class="border-bottom border-gray">
        <?php

            $get_posts_with_comments = $conn->prepare("SELECT * FROM posts WHERE numComments >= 3 ORDER BY numComments DESC LIMIT 5");
            
            $posts_with_comments_array = array();

            $get_posts_with_comments->execute();

            while ($row = $get_posts_with_comments->fetch(PDO::FETCH_ASSOC)) {
                $posts_with_comments_array[] = $row;
                echo '<h6><a class="green" href="post.php?id=' . $posts_with_comments_array['id'] . '&title=' . $posts_with_comments_array['title'] . '">' . $posts_with_comments_array['title'] . '</a></h6>';
            }
        
        ?>
    </div>
</div>