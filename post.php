<?php include 'inc/header.php';?>

          <?php 
              $postslug =  mysqli_real_escape_string($db->link,$_GET['slug']);
              if (!isset($postslug) || $postslug == NULL) {
                  echo "<script>window.location='404.php'</script>";
              }else{
                  $slug = str_replace('/', ' ', $postslug);
                  
              }
            ?>
            <div class="col-md-8">
                <div class="blog">
                    <div class="blog-item">
                        <?php 
            $query = "select * from tbl_post where slug='$slug'";
            $post = $db->select($query);
            if ($post) {
            while ($result = $post->fetch_assoc()) {
        
            ?>
          
              <div class="blog-content">
                  <h3><?php echo $result['title']; ?></h3>
                  <div class="entry-meta">
                      <span><i class="icon-user"></i> <a href="profile.php?id=<?php echo $result['userid']; ?>"><?php echo $result['character_name']; ?></a></span>
                      <span><i class="icon-calendar"></i> <?php echo $fm->formatDate($result['date']); ?></span>
                  </div>
                  <?php echo $result['body']; ?>
                  <?php $id = $result['id']; ?>
              </div>
              <?php } } ?>

              <?php 

                 if ($_SERVER['REQUEST_METHOD']=='POST') {  
                 $message = $_POST['message'];       
                 $message =  mysqli_real_escape_string($db->link,$message);
         
                 if(empty($message)){
                  Session::set("message","Field must not be empty !!!");
                 } else{
                  $character_name = Session::get('characterName');
                  $userid = Session::get('userId');
                  $query = "INSERT INTO tbl_reply(post_id,userid,message,character_name) VALUES ('$id','$userid','$message','$character_name')";
                  $catinsert = $db->insert($query);
                  if($catinsert){
                      Session::set("message","Category Inserted successfully!!!");
                      
                   }   else {
                      Session::set("message","Category Not Inserted !!!");
                    }  
                 }
              }
            ?>

            <?php 

            $division = Session::get('division');
            $rank = Session::get('rank');
            $division_and_rank = 'division '.$division.' rank '.$rank;

             ?>

            <?php 
              $query = "SELECT allowed_divisions_ranks FROM tbl_admin";
              $users = $db->select($query);
              if ($users) {
              
              while ($result = $users->fetch_assoc()) {
            
              $allowed_divisions_ranks = unserialize($result['allowed_divisions_ranks']);
              foreach($allowed_divisions_ranks as $allowed_divisions_rank){
            ?>


             <?php if($allowed_divisions_rank==$division_and_rank){ ?>

                <div class="card my-4">
                  <h5 class="card-header">Leave a Comment:</h5>
                  <div class="card-body">
                    <form action="" method="POST">
                      <div class="form-group">
                        <textarea class="form-control" rows="3" name="message"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
                <?php } } } } ?>
                <?php //echo $id; ?>
                <h2>Comments : </h2>
                    <?php 
                  $query = "select * from tbl_reply where post_id='$id' ORDER BY id DESC";
                  $post = $db->select($query);
                  if ($post) {
                  while ($result = $post->fetch_assoc()) {
              
               ?>
              
              <div class="media mb-4 blog-content">
                
                <div class="media-body">
                

                  <h5 class="mt-0"><a href="profile.php?id=<?php echo $result['userid']; ?>"><?php echo $result['character_name']; ?></a> <span><i class="icon-calendar"></i> <?php echo $fm->formatDate($result['date']); ?></span></h5>

                  <?php echo $result['message']; ?>

                </div>

              </div>

              <?php } }else{
              echo '<h2>No Comment Found...</h2>';
              } ?>
                      </div><!--/.blog-item-->
                  </div>
              </div><!--/.col-md-8-->

<?php include 'inc/sidebar.php'; ?>
<?php include "inc/footer.php";?>