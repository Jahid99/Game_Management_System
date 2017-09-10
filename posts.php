<?php include 'inc/header.php';?>

        <?php 
            $category =  mysqli_real_escape_string($db->link,$_GET['category']);
            if (!isset($category) || $category == NULL) {
                echo "<script>window.location='404.php'</script>";
            }else{
                $id = $category;
            }

        ?>
         
        <?php
            $query = "select id from tbl_category where cat_slug = '$id'";
            $post = $db->select($query);
            if ($post) {
            while ($result = $post->fetch_assoc()) {
                    $id = $result['id'];
                }
            }
            ?>
           
            <div class="col-md-8">
                <div class="blog">
                    <?php 
                        $query = "select * from tbl_post where cat = $id order by id desc";
                        $post = $db->select($query);
                        if ($post) {
                        while ($result = $post->fetch_assoc()) {
                    
                     ?>
                    <div class="blog-item">
                        <div class="blog-content">
                            <a href="<?php echo SITE_URL ?><?php echo $result['slug']; ?>"><h3><?php echo $result['title']; ?></h3></a>
                            <div class="entry-meta">
                                <span><i class="icon-user"></i> <a href="<?php echo SITE_URL ?>profile.php?id=<?php echo $result['userid']; ?>"><?php echo $result['character_name']; ?></a></span>
                                <span><i class="icon-calendar"></i> <?php echo $fm->formatDate($result['date']); ?></span>
                            </div>
                            <?php echo $fm->textShorten($result['body'],425); ?>
                            <a class="btn btn-default" href="<?php echo SITE_URL ?><?php echo $result['slug']; ?>">Read More <i class="icon-angle-right"></i></a>
                        </div>
                    </div><!--/.blog-item--><br>
                 <?php }
                   }else{
                    echo "<h2>No Post Found...</h2>";
                } ?>
                </div>
            </div><!--/.col-md-8-->
                   
<?php include 'inc/sidebar.php'; ?>
<?php include "inc/footer.php";?>